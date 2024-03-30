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

// ==================
// = Plugin Version =
// ==================
define( 'AI1WMGE_VERSION', '2.82' );

// ===============
// = Plugin Name =
// ===============
define( 'AI1WMGE_PLUGIN_NAME', 'all-in-one-wp-migration-gdrive-extension' );

// ============
// = Lib Path =
// ============
define( 'AI1WMGE_LIB_PATH', AI1WMGE_PATH . DIRECTORY_SEPARATOR . 'lib' );

// ===================
// = Controller Path =
// ===================
define( 'AI1WMGE_CONTROLLER_PATH', AI1WMGE_LIB_PATH . DIRECTORY_SEPARATOR . 'controller' );

// ==============
// = Model Path =
// ==============
define( 'AI1WMGE_MODEL_PATH', AI1WMGE_LIB_PATH . DIRECTORY_SEPARATOR . 'model' );

// ===============
// = Export Path =
// ===============
define( 'AI1WMGE_EXPORT_PATH', AI1WMGE_MODEL_PATH . DIRECTORY_SEPARATOR . 'export' );

// ===============
// = Import Path =
// ===============
define( 'AI1WMGE_IMPORT_PATH', AI1WMGE_MODEL_PATH . DIRECTORY_SEPARATOR . 'import' );

// =============
// = View Path =
// =============
define( 'AI1WMGE_TEMPLATES_PATH', AI1WMGE_LIB_PATH . DIRECTORY_SEPARATOR . 'view' );

// ===============
// = Vendor Path =
// ===============
define( 'AI1WMGE_VENDOR_PATH', AI1WMGE_LIB_PATH . DIRECTORY_SEPARATOR . 'vendor' );

// =======================
// = Redirect Create URL =
// =======================
define( 'AI1WMGE_REDIRECT_CREATE_URL', 'https://redirect.wp-migration.com/v1/gdrive/create' );

// ========================
// = Redirect Refresh URL =
// ========================
define( 'AI1WMGE_REDIRECT_REFRESH_URL', 'https://redirect.wp-migration.com/v1/gdrive/refresh' );

// ===========================
// = Default File Chunk Size =
// ===========================
define( 'AI1WMGE_DEFAULT_FILE_CHUNK_SIZE', 5 * 1024 * 1024 );

// ====================================
// = Google Drive Api Default Retries =
// ====================================
define( 'AI1WMGE_DEFAULT_API_RETRIES', 3 );

// ===============================
// = Minimal Base Plugin Version =
// ===============================
define( 'AI1WMGE_MIN_AI1WM_VERSION', '7.79' );

// ===============
// = Purchase ID =
// ===============
define( 'AI1WMGE_PURCHASE_ID', '41599cf5-ea27-484c-b347-40a118b881d2' );
