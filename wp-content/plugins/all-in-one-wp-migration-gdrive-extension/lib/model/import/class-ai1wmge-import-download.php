<?php
/**
 * Copyright (C) 2014-2020 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Kangaroos cannot jump here' );
}

class Ai1wmge_Import_Download {

	public static function execute( $params, Ai1wmge_GDrive_Client $gdrive = null ) {

		$params['completed'] = false;

		// Validate file size
		if ( ! isset( $params['file_size'] ) ) {
			throw new Ai1wm_Import_Exception( __( 'Google Drive File Size is not specified.', AI1WMGE_PLUGIN_NAME ) );
		}

		// Validate download URL
		if ( ! isset( $params['download_url'] ) ) {
			throw new Ai1wm_Import_Exception( __( 'Google Drive Download URL is not specified.', AI1WMGE_PLUGIN_NAME ) );
		}

		// Set file chunk size for download
		$file_chunk_size = get_option( 'ai1wmge_gdrive_file_chunk_size', AI1WMGE_DEFAULT_FILE_CHUNK_SIZE );

		// Set archive offset
		if ( ! isset( $params['archive_offset'] ) ) {
			$params['archive_offset'] = 0;
		}

		// Set file range start
		if ( ! isset( $params['file_range_start'] ) ) {
			$params['file_range_start'] = 0;
		}

		// Set file range end
		if ( ! isset( $params['file_range_end'] ) ) {
			$params['file_range_end'] = $file_chunk_size - 1;
		}

		// Set download retries
		if ( ! isset( $params['download_retries'] ) ) {
			$params['download_retries'] = 0;
		}

		// Set download backoff
		if ( ! isset( $params['download_backoff'] ) ) {
			$params['download_backoff'] = 1;
		}

		// Set Google Drive client
		if ( is_null( $gdrive ) ) {
			$gdrive = new Ai1wmge_GDrive_Client(
				get_option( 'ai1wmge_gdrive_token', false ),
				get_option( 'ai1wmge_gdrive_ssl', true )
			);
		}

		$gdrive->load_download_url( $params['download_url'] );

		// Open the archive file for writing
		if ( ( $archive = fopen( ai1wm_archive_path( $params ), 'cb' ) ) ) {
			if ( ( fseek( $archive, $params['archive_offset'] ) !== -1 ) ) {
				try {

					$params['download_retries'] += 1;
					$params['download_backoff'] *= 2;

					// Download file chunk data
					$gdrive->get_file( $archive, $params['file_range_start'], $params['file_range_end'] );

					// Unset download retries
					unset( $params['download_retries'] );
					// Unset download backoff
					unset( $params['download_backoff'] );

				} catch ( Ai1wmge_Connect_Exception $e ) {
					if ( $params['download_retries'] <= apply_filters( 'ai1wmge_default_api_retries', AI1WMGE_DEFAULT_API_RETRIES ) ) {
						// Set download backoff
						if ( isset( $params['download_backoff'] ) ) {
							sleep( $params['download_backoff'] );
						}
						return $params;
					}

					throw $e;
				}
			}

			// Set archive offset
			$params['archive_offset'] = ftell( $archive );

			// Set file range start
			$params['file_range_start'] = min( $params['file_range_start'] + $file_chunk_size, $params['file_size'] - 1 );

			// Set file range end
			$params['file_range_end'] = min( $params['file_range_end'] + $file_chunk_size, $params['file_size'] - 1 );

			// Get progress
			$progress = (int) ( ( $params['file_range_start'] / $params['file_size'] ) * 100 );

			// Set progress
			if ( defined( 'WP_CLI' ) ) {
				WP_CLI::log( sprintf( __( 'Downloading %s (%s) [%d%% complete]', AI1WMGE_PLUGIN_NAME ), $params['file_path'], $params['file_size'], $progress ) );
			} else {
				Ai1wm_Status::progress( $progress );
			}

			// Completed?
			if ( $params['file_range_start'] === ( $params['file_size'] - 1 ) ) {
				unset( $params['file_size'] );
				unset( $params['download_url'] );
				unset( $params['archive_offset'] );
				unset( $params['file_range_start'] );
				unset( $params['file_range_end'] );
				unset( $params['completed'] );
			}

			fclose( $archive );
		}

		return $params;
	}
}
