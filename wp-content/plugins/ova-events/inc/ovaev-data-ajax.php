<?php if ( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVAEV_loadmore' ) ){
	class OVAEV_loadmore{

		public function __construct(){
			add_action( 'wp_ajax_filter_elementor_grid', array( $this, 'filter_elementor_grid') );
			add_action( 'wp_ajax_nopriv_filter_elementor_grid', array( $this, 'filter_elementor_grid') );

			add_action( 'wp_ajax_search_ajax_events', array( $this, 'search_ajax_events') );
			add_action( 'wp_ajax_nopriv_search_ajax_events', array( $this, 'search_ajax_events') );

			add_action( 'wp_ajax_search_ajax_events_pagination', array( $this, 'search_ajax_events_pagination') );
			add_action( 'wp_ajax_nopriv_search_ajax_events_pagination', array( $this, 'search_ajax_events_pagination') );

			add_action( 'wp_ajax_ovaev_filter_ajax', array( $this, 'ovaev_filter_ajax') );
			add_action( 'wp_ajax_nopriv_ovaev_filter_ajax', array( $this, 'ovaev_filter_ajax') );

			add_action( 'wp_ajax_ovaev_category_filter_ajax', array( $this, 'ovaev_category_filter_ajax') );
			add_action( 'wp_ajax_nopriv_ovaev_category_filter_ajax', array( $this, 'ovaev_category_filter_ajax') );
		}

		/* Ajax Load Post Click Elementor */
		public static function filter_elementor_grid() {

			$filter = sanitize_text_field( $_POST['filter'] );
			$order = sanitize_text_field( $_POST['order'] );
			$orderby = sanitize_text_field( $_POST['orderby'] );
			$number_post = sanitize_text_field( $_POST['number_post'] );
			$column = sanitize_text_field( $_POST['column'] );
			$first_term = sanitize_text_field( $_POST['first_term'] );
			$term_id_filter_string = sanitize_text_field( $_POST['term_id_filter_string'] );
			$show_featured = sanitize_text_field( $_POST['show_featured'] );
			$layout = sanitize_text_field( $_POST['layout'] );

			$args_base = array(
				'post_type' => 'event',
				'post_status' => 'publish',
				'posts_per_page' => $number_post,
				'order' => $order,
				'orderby' => $orderby,
			);
			$term_id_filter = explode(', ', $term_id_filter_string);

			/* Show Featured */
			if ($show_featured == 'yes') {
				$args_featured = array(
					'meta_key' => 'ovaev_special',
					'meta_query'=> array(
						array(
							'key' => 'ovaev_special',
							'compare' => '=',
							'value' => 'checked',
						)
					)
				);
			} else {
				$args_featured = array();
			}

			if ($filter != 'all') {
				$args_cat = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'event_category',
							'field'    => 'id',
							'terms'    => $filter,
						)
					)
				);


				$args = array_merge_recursive($args_cat, $args_base, $args_featured);
				$my_posts = new WP_Query( $args );

			} else {
				$args_cat = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'event_category',
							'field'    => 'id',
							'terms'    => $term_id_filter,
						)
					)
				);

				$args = array_merge_recursive($args_base, $args_cat, $args_featured);
				$my_posts = new WP_Query( $args );
			}
			
			?>

			<?php
			if( $my_posts->have_posts() ) : while( $my_posts->have_posts() ) : $my_posts->the_post();

				$id = get_the_ID();

				$ovaev_cat = get_the_terms( $id, 'event_category' );

				$cat_name = array();
				if ($ovaev_cat != '') {
					foreach ($ovaev_cat as $key => $value) {
						$cat_name[] = $value->name;
					}
				}
				$category_name = join(', ', $cat_name);
				?>

				<div class="wrap_item ">
					<div class="item ">
						<?php
							if ( !empty($layout) && $layout == 1 ) {
								ovaev_get_template( 'event-templates/event-type1.php' );
							} else {
								ovaev_get_template( 'event-templates/event-type3.php' );
							}
						?>
					</div>	
				</div>

			<?php endwhile; endif; wp_reset_postdata(); ?>
			<?php
			wp_die();
		}

		/* Ajax Search Events Elementor */
		public static function search_ajax_events() {
			$start_date = isset( $_POST['start_date'] ) ? sanitize_text_field( $_POST['start_date'] ) 	: '';
			$end_date 	= isset( $_POST['end_date'] ) 	? sanitize_text_field( $_POST['end_date'] ) 	: '';
			$category 	= isset( $_POST['category'] ) 	? sanitize_text_field( $_POST['category'] ) 	: '';
			$layout 	= isset( $_POST['layout'] ) 	? sanitize_text_field( $_POST['layout'] ) 		: 1;
			$column 	= isset( $_POST['column'] ) 	? sanitize_text_field( $_POST['column'] ) 		: 'col3';
			$per_page 	= isset( $_POST['per_page'] ) 	? sanitize_text_field( $_POST['per_page'] ) 	: 6;
			$order 		= isset( $_POST['order'] ) 		? sanitize_text_field( $_POST['order'] ) 		: 'ASC';
			$orderby 	= isset( $_POST['orderby'] ) 	? sanitize_text_field( $_POST['orderby'] ) 		: 'title';
			$cat_slug 	= isset( $_POST['cat_slug'] ) 	? sanitize_text_field( $_POST['cat_slug'] ) 	: 'all';
			$time_event = isset( $_POST['time_event'] ) ? sanitize_text_field( $_POST['time_event'] ) 	: 'all';

			// Args base
			$args = array(
				'post_type' 		=> 'event',
				'post_status' 		=> 'publish',
				'posts_per_page' 	=> $per_page,
				'order' 			=> $order,
				'offset'			=> 0,
			);

			// Date
			if ( $start_date && $end_date ) {
				$args['meta_query'] = array(
					array(
						'relation' => 'OR',
						array(
							'key' 		=> 'ovaev_start_date_time',
							'value' 	=> array( strtotime( $start_date )-1, strtotime( $end_date ) + ( 24*60*60 ) + 1 ),
							'type' 		=> 'numeric',
							'compare' 	=> 'BETWEEN'	
						),
						array(
							'relation' 	=> 'AND',
							array(
								'key' 		=> 'ovaev_start_date_time',
								'value' 	=> strtotime( $start_date ),
								'compare' 	=> '<'
							),
							array(
								'key' 		=> 'ovaev_end_date_time',
								'value' 	=> strtotime( $start_date ),
								'compare' 	=> '>='
							)
						)
					)
				);
			} elseif ( $start_date && ! $end_date ) {
				$args['meta_query'] = array(
					array(
						'relation' => 'OR',
						array(
							'key' 		=> 'ovaev_start_date_time',
							'value' 	=> [ strtotime( $start_date ), strtotime( $start_date ) + 24*60*60 ],
							'compare' 	=> 'BETWEEN'
						),
						array(
							'relation' 	=> 'AND',
							array(
								'key' 		=> 'ovaev_start_date_time',
								'value' 	=> strtotime( $start_date ),
								'compare' 	=> '<'
							),
							array(
								'key' 		=> 'ovaev_end_date_time',
								'value' 	=> strtotime( $start_date ),
								'compare' 	=> '>='
							)
						)
					)
				);
			} elseif ( ! $start_date && $end_date ) {
				$args['meta_query'] = array(
					'key' 		=> 'ovaev_end_date_time',
					'value' 	=> strtotime( $end_date ) + ( 24*60*60 ),
					'compare' 	=> '<='
				);
			} else {
				// Time event
		        if ( 'current' === $time_event ) {
		        	$args['meta_query'] = array(
		                array(
		                    'relation' => 'OR',
		                    array(
		                        'key'     => 'ovaev_start_date_time',
		                        'value'   => array( current_time('timestamp' )-1, current_time('timestamp' )+(24*60*60)+1 ),
		                        'type'    => 'numeric',
		                        'compare' => 'BETWEEN'  
		                    ),
		                    array(
		                        'relation' => 'AND',
		                        array(
		                            'key'     => 'ovaev_start_date_time',
		                            'value'   => current_time('timestamp' ),
		                            'compare' => '<'
		                        ),
		                        array(
		                            'key'     => 'ovaev_end_date_time',
		                            'value'   => current_time('timestamp' ),
		                            'compare' => '>='
		                        ),
		                    ),
		                ),
		            );
		        } elseif ( 'upcoming' === $time_event ) {
		        	$args['meta_query'] = array(
		                array(
		                    array(
		                        'key'     => 'ovaev_start_date_time',
		                        'value'   => current_time( 'timestamp' ),
		                        'compare' => '>'
		                    ),  
		                ),
		            );
		        } elseif ( 'past' === $time_event ) {
		        	$args['meta_query'] = array(
		                array(
		                    'key'     => 'ovaev_end_date_time',
		                    'value'   => current_time('timestamp' ),
		                    'compare' => '<',                   
		                ),
		            );
		        }
			}

			// orderby
			switch ( $orderby ) {
				case 'title':
					$args['orderby'] = $orderby;
				break;

				case 'event_custom_sort':
					$args['orderby'] 	= 'meta_value';
					$args['meta_key'] 	= $orderby;
				break;

				case 'ovaev_start_date_time':
					$args['orderby'] 	= 'meta_value';
					$args['meta_key'] 	= $orderby;
				break;
				
				case 'ID':
					$args['orderby'] = $orderby;
				break;	
			}

			// category
			if ( $category ) {
				$args['tax_query'] = array(
					array(
	                    'taxonomy' => 'event_category',
	                    'field'    => 'slug',
	                    'terms'    => $category,
	                ),
				);
	        } else {
	        	if ( 'all' != $cat_slug ) {
	        		$args['tax_query'] = array(
						array(
		                    'taxonomy' => 'event_category',
		                    'field'    => 'slug',
		                    'terms'    => $cat_slug,
		                ),
					);
	        	}
	        }

	        $events = new \WP_Query( $args );

	        // Events
	        ob_start();
        	?>

        	<!-- Events -->
			<div class="archive_event search-ajax-content<?php echo ' '.esc_attr( $column );?>">
				<?php if( $events->have_posts() ) : while( $events->have_posts() ) : $events->the_post();
					switch ( $layout ) {
						case '1':
							ovaev_get_template( 'event-templates/event-type1.php' );
							break;
						case '2':
							ovaev_get_template( 'event-templates/event-type2.php' );
							break;
						case '3':
							ovaev_get_template( 'event-templates/event-type3.php' );
							break;
						case '4':
							ovaev_get_template( 'event-templates/event-type4.php' );
							break;
						case '5':
							ovaev_get_template( 'event-templates/event-type5.php' );
							break;
						case '6':
							ovaev_get_template( 'event-templates/event-type6.php' );
							break;
						default:
							ovaev_get_template( 'event-templates/event-type1.php' );
					}
				?>

				<?php endwhile; else: wp_reset_postdata(); ?>
					<div class="search_not_found">
						<?php esc_html_e( 'Not Found Events', 'ovaev' ); ?>
					</div>
				<?php endif; wp_reset_postdata(); ?>

				<div class="wrap_loader">
					<svg class="loader" width="50" height="50">
						<circle cx="25" cy="25" r="10" stroke="#a1a1a1"/>
						<circle cx="25" cy="25" r="20" stroke="#a1a1a1"/>
					</svg>
				</div>
			</div>

			<div class="data-events" 
				data-layout="<?php echo esc_attr( $layout ); ?>" 
				data-column="<?php echo esc_attr( $column ); ?>" 
				data-per-page="<?php echo esc_attr( $per_page ); ?>" 
				data-order="<?php echo esc_attr( $order ); ?>" 
				data-orderby="<?php echo esc_attr( $orderby ); ?>" 
				data-category-slug="<?php echo esc_attr( $cat_slug ); ?>" 
				data-time-event="<?php echo esc_attr( $time_event ); ?>">
			</div>
			<!-- End Events -->

        	<?php

        	$result = ob_get_contents(); 
			ob_end_clean();
			// End Events

			// Pagination
			$total_pages = $events->max_num_pages;
			$current 	 = 1;
			ob_start();

			if ( $total_pages > 1 ):
			?>
				<div class="search-ajax-pagination" data-total-page="<?php echo esc_attr( $total_pages ); ?>">
					<ul>
						<?php for ( $i = 1; $i <= $total_pages; $i++ ): ?>
							<?php if ( $i == 1 ): ?>
								<li>
									<span class="prev page-numbers" data-paged="<?php echo esc_attr( $current - 1 ); ?>">
										<?php esc_html_e( 'Previous', 'ovaev' ); ?>
									</span>
								</li>
								<li>
									<span class="page-numbers current" data-paged="<?php echo esc_attr( $i ); ?>">
										<?php echo esc_attr( $i ); ?>
									</span>
								</li>
							<?php elseif ( $i == $total_pages ): ?>
								<li>
									<span class="page-numbers" data-paged="<?php echo esc_attr( $i ); ?>">
										<?php echo esc_attr( $i ); ?>
									</span>
								</li>
								<li>
									<span class="next page-numbers" data-paged="<?php echo esc_attr( $current + 1 ); ?>">
										<?php esc_html_e( 'Next', 'ovaev' ); ?>
									</span>
								</li>
							<?php else: ?>
								<li>
									<span class="page-numbers" data-paged="<?php echo esc_attr( $i ); ?>">
										<?php echo esc_attr( $i ); ?>
									</span>
								</li>
							<?php endif; ?>
						<?php endfor; ?>
					</ul>
				</div>
			<?php
			endif;

			$pagination = ob_get_contents();
			ob_end_clean();
			// End Pagination

			echo json_encode( array( "result" => $result, "pagination" => $pagination ));
			wp_die();
		}

		/* Ajax Search Events Pagination */
		public function search_ajax_events_pagination() {
			$start_date = isset( $_POST['start_date'] ) ? sanitize_text_field( $_POST['start_date'] ) 	: '';
			$end_date 	= isset( $_POST['end_date'] ) 	? sanitize_text_field( $_POST['end_date'] ) 	: '';
			$category 	= isset( $_POST['category'] ) 	? sanitize_text_field( $_POST['category'] ) 	: '';
			$layout 	= isset( $_POST['layout'] ) 	? sanitize_text_field( $_POST['layout'] ) 		: 1;
			$column 	= isset( $_POST['column'] ) 	? sanitize_text_field( $_POST['column'] ) 		: 'col3';
			$per_page 	= isset( $_POST['per_page'] ) 	? sanitize_text_field( $_POST['per_page'] ) 	: 6;
			$order 		= isset( $_POST['order'] ) 		? sanitize_text_field( $_POST['order'] ) 		: 'ASC';
			$orderby 	= isset( $_POST['orderby'] ) 	? sanitize_text_field( $_POST['orderby'] ) 		: 'title';
			$cat_slug 	= isset( $_POST['cat_slug'] ) 	? sanitize_text_field( $_POST['cat_slug'] ) 	: 'all';
			$time_event = isset( $_POST['time_event'] ) ? sanitize_text_field( $_POST['time_event'] ) 	: 'all';
			$offset 	= isset( $_POST['offset'] ) 	? sanitize_text_field( $_POST['offset'] ) 		: 0;

			// Args base
			$args = array(
				'post_type' 		=> 'event',
				'post_status' 		=> 'publish',
				'posts_per_page' 	=> $per_page,
				'order' 			=> $order,
				'paged' 			=> $offset,
				'offset'			=> ( $offset -1 ) * $per_page,
			);

			// Date
			if ( $start_date && $end_date ) {
				$args['meta_query'] = array(
					array(
						'relation' => 'OR',
						array(
							'key' 		=> 'ovaev_start_date_time',
							'value' 	=> array( strtotime( $start_date )-1, strtotime( $end_date ) + ( 24*60*60 ) + 1 ),
							'type' 		=> 'numeric',
							'compare' 	=> 'BETWEEN'	
						),
						array(
							'relation' 	=> 'AND',
							array(
								'key' 		=> 'ovaev_start_date_time',
								'value' 	=> strtotime( $start_date ),
								'compare' 	=> '<'
							),
							array(
								'key' 		=> 'ovaev_end_date_time',
								'value' 	=> strtotime( $start_date ),
								'compare' 	=> '>='
							)
						)
					)
				);
			} elseif ( $start_date && ! $end_date ) {
				$args['meta_query'] = array(
					array(
						'relation' => 'OR',
						array(
							'key' 		=> 'ovaev_start_date_time',
							'value' 	=> [ strtotime( $start_date ), strtotime( $start_date ) + 24*60*60 ],
							'compare' 	=> 'BETWEEN'
						),
						array(
							'relation' 	=> 'AND',
							array(
								'key' 		=> 'ovaev_start_date_time',
								'value' 	=> strtotime( $start_date ),
								'compare' 	=> '<'
							),
							array(
								'key' 		=> 'ovaev_end_date_time',
								'value' 	=> strtotime( $start_date ),
								'compare' 	=> '>='
							)
						)
					)
				);
			} elseif ( ! $start_date && $end_date ) {
				$args['meta_query'] = array(
					'key' 		=> 'ovaev_end_date_time',
					'value' 	=> strtotime( $end_date ) + ( 24*60*60 ),
					'compare' 	=> '<='
				);
			} else {
				// Time event
		        if ( 'current' === $time_event ) {
		        	$args['meta_query'] = array(
		                array(
		                    'relation' => 'OR',
		                    array(
		                        'key'     => 'ovaev_start_date_time',
		                        'value'   => array( current_time('timestamp' )-1, current_time('timestamp' )+(24*60*60)+1 ),
		                        'type'    => 'numeric',
		                        'compare' => 'BETWEEN'  
		                    ),
		                    array(
		                        'relation' => 'AND',
		                        array(
		                            'key'     => 'ovaev_start_date_time',
		                            'value'   => current_time('timestamp' ),
		                            'compare' => '<'
		                        ),
		                        array(
		                            'key'     => 'ovaev_end_date_time',
		                            'value'   => current_time('timestamp' ),
		                            'compare' => '>='
		                        ),
		                    ),
		                ),
		            );
		        } elseif ( 'upcoming' === $time_event ) {
		        	$args['meta_query'] = array(
		                array(
		                    array(
		                        'key'     => 'ovaev_start_date_time',
		                        'value'   => current_time( 'timestamp' ),
		                        'compare' => '>'
		                    ),  
		                ),
		            );
		        } elseif ( 'past' === $time_event ) {
		        	$args['meta_query'] = array(
		                array(
		                    'key'     => 'ovaev_end_date_time',
		                    'value'   => current_time('timestamp' ),
		                    'compare' => '<',                   
		                ),
		            );
		        }
			}

			// orderby
			switch ( $orderby ) {
				case 'title':
					$args['orderby'] = $orderby;
				break;

				case 'event_custom_sort':
					$args['orderby'] 	= 'meta_value';
					$args['meta_key'] 	= $orderby;
				break;

				case 'ovaev_start_date_time':
					$args['orderby'] 	= 'meta_value';
					$args['meta_key'] 	= $orderby;
				break;
				
				case 'ID':
					$args['orderby'] = $orderby;
				break;	
			}

			// category
			if ( $category ) {
				$args['tax_query'] = array(
					array(
	                    'taxonomy' => 'event_category',
	                    'field'    => 'slug',
	                    'terms'    => $category,
	                ),
				);
	        } else {
	        	if ( 'all' != $cat_slug ) {
	        		$args['tax_query'] = array(
						array(
		                    'taxonomy' => 'event_category',
		                    'field'    => 'slug',
		                    'terms'    => $cat_slug,
		                ),
					);
	        	}
	        }

	        $events = new \WP_Query( $args );

	        // Events
	        ob_start();
        	?>

        	<!-- Events -->
			<div class="archive_event search-ajax-content<?php echo ' '.esc_attr( $column );?>">
				<?php if( $events->have_posts() ) : while( $events->have_posts() ) : $events->the_post();
					switch ( $layout ) {
						case '1':
							ovaev_get_template( 'event-templates/event-type1.php' );
							break;
						case '2':
							ovaev_get_template( 'event-templates/event-type2.php' );
							break;
						case '3':
							ovaev_get_template( 'event-templates/event-type3.php' );
							break;
						case '4':
							ovaev_get_template( 'event-templates/event-type4.php' );
							break;
						case '5':
							ovaev_get_template( 'event-templates/event-type5.php' );
							break;
						case '6':
							ovaev_get_template( 'event-templates/event-type6.php' );
							break;
						default:
							ovaev_get_template( 'event-templates/event-type1.php' );
					}
				?>

				<?php endwhile; else: wp_reset_postdata(); ?>
					<div class="search_not_found">
						<?php esc_html_e( 'Not Found Events', 'ovaev' ); ?>
					</div>
				<?php endif; wp_reset_postdata(); ?>

				<div class="wrap_loader">
					<svg class="loader" width="50" height="50">
						<circle cx="25" cy="25" r="10" stroke="#a1a1a1"/>
						<circle cx="25" cy="25" r="20" stroke="#a1a1a1"/>
					</svg>
				</div>
			</div>

			<div class="data-events" 
				data-layout="<?php echo esc_attr( $layout ); ?>" 
				data-column="<?php echo esc_attr( $column ); ?>" 
				data-per-page="<?php echo esc_attr( $per_page ); ?>" 
				data-order="<?php echo esc_attr( $order ); ?>" 
				data-orderby="<?php echo esc_attr( $orderby ); ?>" 
				data-category-slug="<?php echo esc_attr( $cat_slug ); ?>" 
				data-time-event="<?php echo esc_attr( $time_event ); ?>">
			</div>
			<!-- End Events -->

        	<?php

        	$result = ob_get_contents(); 
			ob_end_clean();
			// End Events

			echo json_encode( array( "result" => $result ) );
			wp_die();
		}

		/* Filter Event Ajax */
		public static function ovaev_filter_ajax() {
			$settings 	= isset( $_POST['settings'] ) ? $_POST['settings'] : '';
			$start_date = isset( $_POST['start_date'] ) && $_POST['start_date'] ? strtotime( $_POST['start_date'] ) : '';
			$end_date 	= isset( $_POST['end_date'] ) && $_POST['start_date'] ? strtotime( $_POST['end_date'] . ' 23:59' ) : '';
			$keyword 	= isset( $_POST['keyword'] ) ? sanitize_text_field( $_POST['keyword'] ) : '';
			$time 		= isset( $_POST['time'] ) ? sanitize_text_field( $_POST['time'] ) : '';
			$categories = isset( $_POST['categories'] ) ? $_POST['categories'] : '';

			// Base
			$args_base = array(
				'post_type' 		=> 'event',
				'post_status' 		=> 'publish',
				'posts_per_page' 	=> $settings['page_per_posts'],
				'order' 			=> $settings['order'],
			);

			// Sort
			if ( $settings['orderby'] === 'ovaev_start_date_time' || $settings['orderby'] === 'event_custom_sort' ) {
		        $args_base['meta_key'] 	= $settings['orderby'];
		        $args_base['orderby'] 	= 'meta_value_num';
		        $args_base['meta_type'] = 'NUMERIC';
		    } else {
		        $args_base['orderby'] = $settings['orderby'];
		    }

		    // Keyword
		    if ( $keyword ) {
		    	$args_base['s'] = $keyword;
		    }

		    // Date
		    $args_date = [];
		    if ( $start_date && $end_date ) {
		    	$args_date = array(
					'meta_query' => array(
						'relation' => 'AND',
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => $start_date,
                            'compare' => '>'
                        ),
                        array(
                            'key'     => 'ovaev_end_date_time',
                            'value'   => $end_date,
                            'compare' => '<='
                        ),
	                )
				);
		    } elseif ( $start_date && ! $end_date ) {
		    	$args_date = array(
					'meta_query' => array(
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => $start_date,
                            'compare' => '>='
                        ),
	                )
				);
		    } elseif ( ! $start_date && $end_date ) {
		    	$args_date = array(
					'meta_query' => array(
                        array(
                            'key'     => 'ovaev_end_date_time',
                            'value'   => $end_date,
                            'compare' => '<='
                        ),
	                )
				);
		    } else {
		    	$args_date = [];
		    }

		    // Time
			$args_time = [];
			if ( $time === 'today' ) {
				$end = ovaev_get_end_date( 'today' );

				$args_time = array(
					'meta_query' => array(
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => array( current_time( 'timestamp' ), $end ),
                            'type'    => 'numeric',
                        	'compare' => 'BETWEEN'
                        ),
	                )
				);
			} elseif ( $time === 'week' ) {
				$end = ovaev_get_end_date( 'week' );

				$args_time = array(
					'meta_query' => array(
                        array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => array( current_time( 'timestamp' ), $end ),
                            'type'    => 'numeric',
                        	'compare' => 'BETWEEN'
                        ),
	                )
				);
			} elseif ( $time === 'weekend' ) {
				$date_format 	= OVAEV_Settings::archive_event_format_date();
				$start 			= strtotime( date( $date_format, strtotime('this Saturday') ) );
				$end 			= ovaev_get_end_date( 'weekend' );

				$args_time = array(
					'meta_query' => array(
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => array( $start, $end ),
                            'type'    => 'numeric',
                        	'compare' => 'BETWEEN'
                       	),
	                )
				);
			} elseif ( $time === 'upcoming' ) {
				$args_time = array(
					'meta_query' => array(
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => current_time( 'timestamp' ),
                            'compare' => '>'
                        ),
	                )
				);
			} else {
				$args_time = [];
			}

			// Category in
			$args_category = [];
			if ( ! empty( $categories ) && is_array( $categories ) ) {
				$args_category = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'event_category',
							'field'    => 'term_id',
							'terms'    => $categories,
							'operator' => 'IN',
						)
					)
				);
			}

			$query 	= array_merge_recursive( $args_base, $args_date, $args_time, $args_category );
			$events = new \WP_Query( $query );

			$incl 		= $settings['incl_category'] ? explode( ",", $settings['incl_category'] ) : [];
			$excl 		= $settings['excl_category'] ? explode( ",", $settings['excl_category'] ) : [];
			$categories = ovaev_get_categories_events( $events, $incl, $excl );

			// Events
	        ob_start();
        	?>
        		<div class="archive_event ovaev-filter-column<?php echo esc_attr( $settings['column'] );?>">
					<?php if ( $events->have_posts() ) : while(  $events->have_posts() ) : $events->the_post();
						switch ( $settings['template'] ) {
							case '1':
								ovaev_get_template( 'event-templates/event-type1.php' );
								break;
							case '2':
								ovaev_get_template( 'event-templates/event-type2.php' );
								break;
							case '3':
								ovaev_get_template( 'event-templates/event-type3.php' );
								break;
							case '4':
								ovaev_get_template( 'event-templates/event-type4.php' );
								break;
							case '5':
								ovaev_get_template( 'event-templates/event-type5.php' );
								break;
							case '6':
								ovaev_get_template( 'event-templates/event-type6.php' );
								break;
							default:
								ovaev_get_template( 'event-templates/event-type1.php' );
						}
					?>

					<?php endwhile; else: wp_reset_postdata(); ?>
						<div class="search_not_found">
							<?php esc_html_e( 'No event found', 'ovaev' ); ?>
						</div>
					<?php endif; wp_reset_postdata(); ?>
				</div>
        	<?php

        	$result = ob_get_contents(); 
			ob_end_clean();
			// End Events
			
			// Categories
	        ob_start();
	        
	        if ( ! empty( $categories ) && is_array( $categories ) ) {
	        	foreach ( $categories as $item_cat ) {
	        		?>
	        		<li class="item-cat">
						<?php if ( $item_cat['icon_class'] ): ?>
							<i class="<?php echo esc_attr( $item_cat['icon_class'] ); ?>" aria-hidden="true"></i>
						<?php endif; ?>
						<a href="javascript:void(0)" class="ovaev-term" data-term-id="<?php echo esc_attr( $item_cat['term_id'] ); ?>">
							<?php echo esc_html( $item_cat['name'] ); ?>
							<span class="count"><?php printf( esc_html__( '(%s)' ), $item_cat['count'] ); ?></span>	
						</a>
					</li>
	        		<?php
	        	}
	        }

	        $category = ob_get_contents(); 
			ob_end_clean();
			// End Events

			echo json_encode( array( "result" => $result, 'category' => $category ) );
			wp_die();
		}

		/* Category Filter Event Ajax */
		public static function ovaev_category_filter_ajax() {
			$settings 	= isset( $_POST['settings'] ) ? $_POST['settings'] : '';
			$start_date = isset( $_POST['start_date'] ) && $_POST['start_date'] ? strtotime( $_POST['start_date'] ) : '';
			$end_date 	= isset( $_POST['end_date'] ) && $_POST['start_date'] ? strtotime( $_POST['end_date'] . ' 23:59' ) : '';
			$keyword 	= isset( $_POST['keyword'] ) ? sanitize_text_field( $_POST['keyword'] ) : '';
			$time 		= isset( $_POST['time'] ) ? sanitize_text_field( $_POST['time'] ) : '';
			$categories = isset( $_POST['categories'] ) ? $_POST['categories'] : '';

			// Base
			$args_base = array(
				'post_type' 		=> 'event',
				'post_status' 		=> 'publish',
				'posts_per_page' 	=> $settings['page_per_posts'],
				'order' 			=> $settings['order'],
			);

			// Sort
			if ( $settings['orderby'] === 'ovaev_start_date_time' || $settings['orderby'] === 'event_custom_sort' ) {
		        $args_base['meta_key'] 	= $settings['orderby'];
		        $args_base['orderby'] 	= 'meta_value_num';
		        $args_base['meta_type'] = 'NUMERIC';
		    } else {
		        $args_base['orderby'] = $settings['orderby'];
		    }

		    // Keyword
		    if ( $keyword ) {
		    	$args_base['s'] = $keyword;
		    }

		    // Date
		    $args_date = [];
		    if ( $start_date && $end_date ) {
		    	$args_date = array(
					'meta_query' => array(
						'relation' => 'AND',
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => $start_date,
                            'compare' => '>'
                        ),
                        array(
                            'key'     => 'ovaev_end_date_time',
                            'value'   => $end_date,
                            'compare' => '<='
                        ),
	                )
				);
		    } elseif ( $start_date && ! $end_date ) {
		    	$args_date = array(
					'meta_query' => array(
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => $start_date,
                            'compare' => '>='
                        ),
	                )
				);
		    } elseif ( ! $start_date && $end_date ) {
		    	$args_date = array(
					'meta_query' => array(
                        array(
                            'key'     => 'ovaev_end_date_time',
                            'value'   => $end_date,
                            'compare' => '<='
                        ),
	                )
				);
		    } else {
		    	$args_date = [];
		    }

		    // Time
			$args_time = [];
			if ( $time === 'today' ) {
				$end = ovaev_get_end_date( 'today' );

				$args_time = array(
					'meta_query' => array(
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => array( current_time( 'timestamp' ), $end ),
                            'type'    => 'numeric',
                        	'compare' => 'BETWEEN'
                        ),
	                )
				);
			} elseif ( $time === 'week' ) {
				$end = ovaev_get_end_date( 'week' );

				$args_time = array(
					'meta_query' => array(
                        array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => array( current_time( 'timestamp' ), $end ),
                            'type'    => 'numeric',
                        	'compare' => 'BETWEEN'
                        ),
	                )
				);
			} elseif ( $time === 'weekend' ) {
				$date_format 	= OVAEV_Settings::archive_event_format_date();
				$start 			= strtotime( date( $date_format, strtotime('this Saturday') ) );
				$end 			= ovaev_get_end_date( 'weekend' );

				$args_time = array(
					'meta_query' => array(
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => array( $start, $end ),
                            'type'    => 'numeric',
                        	'compare' => 'BETWEEN'
                       	),
	                )
				);
			} elseif ( $time === 'upcoming' ) {
				$args_time = array(
					'meta_query' => array(
	                    array(
                            'key'     => 'ovaev_start_date_time',
                            'value'   => current_time( 'timestamp' ),
                            'compare' => '>'
                        ),
	                )
				);
			} else {
				$args_time = [];
			}

			// Category in
			$args_category = [];
			if ( ! empty( $categories ) && is_array( $categories ) ) {
				$args_category = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'event_category',
							'field'    => 'term_id',
							'terms'    => $categories,
							'operator' => 'IN',
						)
					)
				);
			}

			$query 	= array_merge_recursive( $args_base, $args_date, $args_time, $args_category );
			$events = new \WP_Query( $query );

			// Events
	        ob_start();
        	?>
        		<div class="archive_event ovaev-filter-column<?php echo esc_attr( $settings['column'] );?>">
					<?php if ( $events->have_posts() ) : while(  $events->have_posts() ) : $events->the_post();
						switch ( $settings['template'] ) {
							case '1':
								ovaev_get_template( 'event-templates/event-type1.php' );
								break;
							case '2':
								ovaev_get_template( 'event-templates/event-type2.php' );
								break;
							case '3':
								ovaev_get_template( 'event-templates/event-type3.php' );
								break;
							case '4':
								ovaev_get_template( 'event-templates/event-type4.php' );
								break;
							case '5':
								ovaev_get_template( 'event-templates/event-type5.php' );
								break;
							case '6':
								ovaev_get_template( 'event-templates/event-type6.php' );
								break;
							default:
								ovaev_get_template( 'event-templates/event-type1.php' );
						}
					?>

					<?php endwhile; else: wp_reset_postdata(); ?>
						<div class="search_not_found">
							<?php esc_html_e( 'No event found', 'ovaev' ); ?>
						</div>
					<?php endif; wp_reset_postdata(); ?>
				</div>
        	<?php

        	$result = ob_get_contents(); 
			ob_end_clean();
			// End Events

			echo json_encode( array( "result" => $result ) );
			wp_die();
		}
	}
	new OVAEV_loadmore();
}
?>