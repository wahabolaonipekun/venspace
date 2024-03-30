<?php if( ! defined( 'ABSPATH' ) ) exit();

extract( $args );

$posts_per_page   	= $args['posts_per_page'];
$orderby   			= isset( $args['orderby'] ) && $args['orderby'] ? $args['orderby'] : 'ID';
$order   			= isset( $args['order'] ) && $args['order'] ? $args['order'] : 'DESC';
$defautl_category 	= $args['default_category'] && is_array( $args['default_category'] ) ? $args['default_category'] : [];
$args['method']   	= 'POST';

$search_results_layout 	= $args['search_results_layout'];
$search_style 	= $args['search_style'];
$grid_column 			= $args['search_results_grid_column'];
$thumbnail_type 		= isset( $args['thumbnail_type'] ) ? $args['thumbnail_type'] : 'image';

if ( isset( $args['search_result'] ) && ( 'new_page' == $args['search_result'] ) ) {
	$action = $args['search_result_url']['url'];
}
$method = isset( $args['method'] ) ? $args['method'] : 'GET';
// Avanced Search Settings
$show_advanced_search    = $args['show_advanced_search'];
$show_price_filter    	 = $args['show_price_filter'];
$show_review_filter 	 = $args['show_review_filter'];
$show_category_filter    = $args['show_category_filter'];
$advanced_search_label   = $args['advanced_search_label'];
$advanced_search_icon    = $args['advanced_search_icon'];
$filter_price_label      = $args['filter_price_label'];
$review_label            = $args['review_label'];
$filter_category_label   = $args['filter_category_label'];
$excl_category 			 = $args['excl_category'];

$filter_duration_label   = $args['filter_duration_label'];
$show_duration_filter 	 = $args['show_duration_filter'];
$duration_fields         = isset($args['duration_fields']) ? $args['duration_fields'] : '';

// Show category
$show_category = '';

if ( $show_advanced_search === 'yes' && $show_category_filter === 'yes' ) {
	$show_category = 'yes';
}

// Filter Settings
$show_filter             = $args['show_filter'];
$tour_found_text         = $args['tour_found_text'];
$clear_filter_text       = $args['clear_filter_text'];

// list category
$args_product_categories = array(
    'taxonomy'   => "product_cat",
    'orderby' 	 => 'ID',
	'order' 	 => 'DESC',
	'exclude' 	 => $excl_category,
);

$product_categories  = get_categories( $args_product_categories );

// get min max price
$prices              = ovabrw_get_filtered_price();
$min_price           = floor( $prices->min_price ? $prices->min_price : 0 );
$max_price           = round( $prices->max_price ? $prices->max_price : 0 );
$currency_symbol     = get_woocommerce_currency_symbol();

?>

<div class="ovabrw-search-ajax">
	<div class="wrap-search-ajax" 
	    data-adults="<?php echo esc_attr( $args['default_adult_number'] ) ;?>"
	    data-childrens="<?php echo esc_attr( $args['default_children_number'] ) ;?>"
	    data-sort_by_default="<?php echo esc_attr( $args['sort_by_default'] ) ;?>"
	    data-start-price="<?php echo esc_attr( $min_price ) ;?>"
	    data-end-price="<?php echo esc_attr( $max_price ) ;?>"
	    data-grid_column="<?php echo esc_attr( $grid_column ) ;?>"
	    data-thumbnail-type="<?php echo esc_attr( $thumbnail_type ); ?>">
		
		<!-- Search -->
		<?php ovabrw_get_template('single/ovabrw_search.php', $args) ; $Attendeelists=array('no'=>'Attendees'); $searchPrices = array('no'=>'Price');		
		?>

		<!-- search lease -->
		<form action="<?php echo esc_url( $action ); ?>" method="<?php echo esc_attr( $method ); ?>" class="ovabrw-search-filter-data ovabrw-search-form">
			<?php if(isset($search_style) && $search_style == 'plain'): ?>
			<div class="vs-flex">
				<div class="vs-flex-16">
					<div class="vs-mg-right-10">
						<div class="vs-pd-bottom-12">
							<span class="ovabrw-label-title vs-fw-800 vs-d-block">
									Attendees
								</span>
						</div>
						<div>
							<div class="guests-button vs-flex vs-a-items-center">
								<div class="guests-icon minus vs-mg-right-10">
									<i class="fa fa-minus" onclick="loadAttendees('minus','ovabrw_adults'); return false;"></i>
								</div>
								<input 
									type="text" 
									id="ovabrw_adults" 
									name="ovabrw_adults" 
									class="ovabrw_adults vs-mg-right-10 vs-width-100" 
									value="<?php echo esc_attr( $default_adult_number ); ?>" 
									min="<?php echo esc_attr( $min_adult ); ?>" 
									max="<?php echo esc_attr( $max_adult ); ?>" />
								<div class="guests-icon plus vs-mg-right-10">
									<i class="fa fa-plus" onclick="loadAttendees('plus','ovabrw_adults'); return false;"></i>
								</div>
							</div>
						</div>
					</div>
	<!-- 				<select class="vs-b-radius-10"> 
						<?php //foreach ($Attendeelists as $key => $Attendeelist): ?>
							<option value="<?php //echo esc_attr(($key != 'no') ? $key : ''); ?>"><?php //printf( __('%s', 'new_tripgo'), $Attendeelist); ?></option>
						<?php //endforeach; ?>
					</select> -->
				</div>
				<div class="search-advanced-field price-field vs-flex-34 vs-mg-right-10">
							<span class="ovabrw-label">
								<?php echo esc_html($filter_price_label) ; ?>
							</span>
							<div class="brw-tour-price-input" data-currency_symbol="<?php echo esc_attr($currency_symbol); ?>">
								<input type="text" class="brw-tour-price-from" value="<?php echo esc_attr($min_price) ;?>" data-value="<?php echo esc_attr($min_price) ;?>"/>
								<input type="text" class="brw-tour-price-to" value="<?php echo esc_attr($max_price) ;?>" data-value="<?php echo esc_attr($max_price) ;?>"/>
							</div>
							<div class="slider-wrapper">
								<div id="brw-tour-price-slider"></div>
							</div> 
						</div>
	<!-- 			<select class="vs-b-radius-10 vs-flex-14 vs-mg-right-10"> -->
					<?php //foreach ($searchPrices as $key => $searchPrice): ?>
	<!-- 					<option value="<?php //echo esc_attr(($key != 'no') ? $key : ''); ?>"><?php //printf( __('%s', 'new_tripgo'), $searchPrice); ?></option> -->
					<?php //endforeach; ?>
	<!-- 			</select> -->
				<div class="vs-flex-34">
					<div class="vs-pd-bottom-12">
						<span class="ovabrw-label-title vs-fw-800 vs-d-block">
								Search Keyword
							</span>
					</div>
					<input placeholder="Enter a keyword" class="vs-b-radius-5 vs-pd-12-15 vs-border-1" name="search_name">
				</div>
			</div>
			<div class="">
				<div class="" style="position:relative;">
					<div class="slick-carousel vs-pd-top-30 vs-pd-bottom-30">
						<span class="vs-mg-right-10 vs-bg-color-ebebeb vs-pd-10-20 vs-b-radius-50 catSpanData" onclick="setCategoryValue(event, 'all'); return false;"><i class=""></i> All</span>
						<?php foreach ( $product_categories as $pro_cat ) : ?>
							<input 
						        	     				id="tour-category-filter-<?php echo esc_attr( $pro_cat->slug ); ?>" 
						        	     				type="checkbox" 
						        	     				class="tour-category-filter" 
						        	     				name="category_value" 
						        	     				value="<?php echo esc_attr($pro_cat->slug) ;?>" style="display:none;"
						        	     			>
							<span class="vs-mg-right-10 vs-bg-color-ebebeb vs-pd-10-20 vs-b-radius-50 none-selected-color" onclick="setCategoryValue(event, '<?php echo esc_attr($pro_cat->slug) ;?>'); return false;"><i class="fa fa-pencil"></i> <?php echo esc_html( $pro_cat->name ) ; ?></span>
						<?php endforeach; ?>
					</div>
					<div class="slick-prev">Previous</div>
					<div class="slick-next">Next</div>
				</div>
			</div>
			<div class="ovabrw-search-btn" style="display:none;">
				<button class="ovabrw-btn" type="submit">
					Search
				</button>
			</div>
		</form>
		<?php else: ?>
		<!-- Advanced Search -->
		<?php if ( $show_advanced_search === 'yes') : ?>
	        <div class="ovabrw-search-advanced">

	        	<div class="search-advanced-input">
	        		<?php if( $advanced_search_icon ) { ?>
		        		<div class="advanced-search-icon">
		        			<?php \Elementor\Icons_Manager::render_icon( $advanced_search_icon, [ 'aria-hidden' => 'true' ] ); ?>
		        		</div>
	        		<?php } ?>
		        	<span class="search-advanced-text">
		        		<?php echo esc_html( $advanced_search_label ); ?>
		        	</span>
		        	<i aria-hidden="true" class="icomoon icomoon-chevron-down"></i>
	        	</div>

	        	<div class="search-advanced-field-wrapper">
	        		<?php if ( $show_price_filter === 'yes' ): ?>
	        		<!-- Price Filter -->
	        	    <div class="search-advanced-field price-field">
	        	    	<span class="ovabrw-label">
	        	    		<?php echo esc_html($filter_price_label) ; ?>
	        	    	</span>
	        	    	<div class="brw-tour-price-input" data-currency_symbol="<?php echo esc_attr($currency_symbol); ?>">
		        	    	<input type="text" class="brw-tour-price-from" value="<?php echo esc_attr($min_price) ;?>" data-value="<?php echo esc_attr($min_price) ;?>"/>
							<input type="text" class="brw-tour-price-to" value="<?php echo esc_attr($max_price) ;?>" data-value="<?php echo esc_attr($max_price) ;?>"/>
						</div>
	        	     	<div class="slider-wrapper">
						    <div id="brw-tour-price-slider"></div>
						</div> 
	        	    </div>
	        		<?php endif; ?>
	        		<?php if ( $show_review_filter === 'yes' ): ?>
	        	    <!-- Rating Filter -->
	        	    <div class="search-advanced-field rating-field">
	        	    	<span class="ovabrw-label">
	        	    		<?php echo esc_html($review_label) ; ?>
	        	    	</span>
	        	     	<?php for( $i = 5; $i>=1 ; $i--) { ?>
	        	     		<div class="total-rating-stars">

	        	     			<div class="input-rating">
	        	     				<input id="rating-filter-<?php echo esc_attr($i) ;?>" type="checkbox" class="rating-filter" name="rating_value[<?php echo esc_attr($i) ;?>]" value="<?php echo esc_attr($i) ;?>">

	        	     				<label for="rating-filter-<?php echo esc_attr($i) ;?>">
	        	     					<?php switch ($i) {
	        	     						case 1: ?>
												<span class="rating-stars">
													<span class="star star-1" data-rating-val="1"><i class="fas fa-star"></i></span>
												</span>
												<?php break; ?>
											<?php case 2: ?>
												<span class="rating-stars">
													<span class="star star-1" data-rating-val="1"><i class="fas fa-star"></i></span>
													<span class="star star-2" data-rating-val="2"><i class="fas fa-star"></i></span>
												</span>
												<?php break; ?>
											<?php case 3: ?>
												<span class="rating-stars">
													<span class="star star-1" data-rating-val="1"><i class="fas fa-star"></i></span>
													<span class="star star-2" data-rating-val="2"><i class="fas fa-star"></i></span>
													<span class="star star-3" data-rating-val="3"><i class="fas fa-star"></i></span>
												</span>
												<?php break; ?>
											<?php case 4: ?>
												<span class="rating-stars">
													<span class="star star-1" data-rating-val="1"><i class="fas fa-star"></i></span>
													<span class="star star-2" data-rating-val="2"><i class="fas fa-star"></i></span>
													<span class="star star-3" data-rating-val="3"><i class="fas fa-star"></i></span>
													<span class="star star-4" data-rating-val="4"><i class="fas fa-star"></i></span>
												</span>
											    <?php break; ?>
		        	     					<?php case 5: ?>
												<span class="rating-stars">
													<span class="star star-1" data-rating-val="1"><i class="fas fa-star"></i></span>
													<span class="star star-2" data-rating-val="2"><i class="fas fa-star"></i></span>
													<span class="star star-3" data-rating-val="3"><i class="fas fa-star"></i></span>
													<span class="star star-4" data-rating-val="4"><i class="fas fa-star"></i></span>
													<span class="star star-5" data-rating-val="5"><i class="fas fa-star"></i></span> 
												</span>
											    <?php break; ?>
									   <?php } ?>
									</label>

	        	     			</div>

	        	     		</div>
	        	     	<?php } ?>
	        	    </div>
	        	    <?php endif; ?>
	        	    <?php if ( $show_category_filter === 'yes' ): ?>
	        	    <!-- Tour Categories Filter -->
	        	    <div class="search-advanced-field tour-categories-field">
	        	    	<span class="ovabrw-label">
	        	    		<?php echo esc_html($filter_category_label) ; ?>
	        	    	</span>
	        	     	<?php foreach ( $product_categories as $pro_cat ) : ?>
	        	     		<?php if ( $pro_cat->category_parent == 0 ) { 
	        	     			$cat_id = $pro_cat->term_id;

	        	     			$args_product_categories_2 = array(
					                'taxonomy'   => 'product_cat',
					                'child_of'   => 0,
					                'parent'     => $cat_id,
					                'orderby' 	 => 'ID',
									'order' 	 => 'DESC',
									'exclude' 	 => $excl_category,
						        );
						        $sub_cats = get_categories( $args_product_categories_2 );
	        	     		?>
		        	     		<div class="tour-category-field">

		        	     			<input 
		        	     				id="tour-category-filter-<?php echo esc_attr( $pro_cat->slug ) ;?>" 
		        	     				type="checkbox" 
		        	     				class="tour-category-filter" 
		        	     				name="category_value" 
		        	     				value="<?php echo esc_attr( $pro_cat->slug ) ;?>" 
		        	     				<?php echo in_array( $pro_cat->slug, $defautl_category ) ? 'checked' : ''; ?>/>

			        	     		<label for="tour-category-filter-<?php echo esc_attr($pro_cat->slug) ;?>">
										<span class="tour-category-name">
											<?php echo esc_html( $pro_cat->name ) ; ?>
										</span>
									</label>

									<?php if ( $sub_cats ) { foreach ( $sub_cats as $sub_category ) { ?>
							            <div class="tour-category-field-child">
				        	     			<input 
				        	     				id="tour-category-filter-<?php echo esc_attr( $sub_category->slug ) ;?>" type="checkbox" 
				        	     				class="tour-category-filter" 
				        	     				name="category_value" 
				        	     				value="<?php echo esc_attr($sub_category->slug) ;?>" 
				        	     				<?php echo in_array( $sub_category->slug, $defautl_category ) ? 'checked' : ''; ?>/>

					        	     		<label for="tour-category-filter-<?php echo esc_attr( $sub_category->slug ) ;?>">
												<span class="tour-category-name">
													<?php echo esc_html( $sub_category->name ) ; ?>
												</span>
											</label>
											
											<?php 
					        	     			$sub_cat_id = $sub_category->term_id; 
					        	     			$args_product_categories_3 = array(
									                'taxonomy'   => 'product_cat',
									                'child_of'   => 0,
									                'parent'     => $sub_cat_id,
									                'orderby' 	 => 'ID',
													'order' 	 => 'DESC',
													'exclude' 	 => $excl_category,
										        );
										        $sub_cats_2 = get_categories( $args_product_categories_3 );
										    ?>

									        <?php if( $sub_cats_2 ) { foreach ( $sub_cats_2 as $sub_category_2 ) { ?>
									            <div class="tour-category-field-child">
						        	     			<input 
						        	     				id="tour-category-filter-<?php echo esc_attr( $sub_category_2->slug ) ;?>" 
						        	     				type="checkbox" 
						        	     				class="tour-category-filter" 
						        	     				name="category_value" 
						        	     				value="<?php echo esc_attr( $sub_category_2->slug ) ;?>" 
						        	     				<?php echo in_array( $sub_category_2->slug, $defautl_category ) ? 'checked' : ''; ?>/>
							        	     		<label for="tour-category-filter-<?php echo esc_attr( $sub_category_2->slug ) ;?>">
														<span class="tour-category-name">
															<?php echo esc_html( $sub_category_2->name ) ; ?>
														</span>
													</label>
												</div>
											<?php } } ?>
											
										</div>
										
							        <?php } } ?> 

			        	     	</div>
			        	    <?php } ?>
	        	     	<?php endforeach;?>
	        	    </div>
	        	    <?php endif; ?>
	        	    <!-- Duration Filter -->
	        		<?php if ( $show_duration_filter === 'yes' ): ?>
		        	    <div class="search-advanced-field tour-duration-field">
		        	    	<span class="ovabrw-label">
		        	    		<?php echo esc_html($filter_duration_label) ; ?>
		        	    	</span>
		        	    	<?php if( is_array($duration_fields) ) : foreach( $duration_fields as $k => $duration_field) :
	                			if( $duration_field['duration_type'] === "day" ) {
	                				$value_from = $duration_field['duration_day_value_from'];
	                				$value_to   = $duration_field['duration_day_value_to'];

	                		    } elseif( $duration_field['duration_type'] === "hour" ) {
	                		    	$value_from = $duration_field['duration_hour_value_from'];
	                				$value_to   = $duration_field['duration_hour_value_to'];
	                            }
	                		?>
		                		<div class="duration-field">
			                		<input id="duration-filter-<?php echo esc_attr($k) ;?>" type="radio" class="duration-filter" name="duration_value_from" value="<?php echo esc_attr($value_from) ;?>">
			                		<input type="hidden" class="duration-filter-to" name="duration_value_to" value="<?php echo esc_attr($value_to) ;?>">
			                		<input type="hidden" class="duration-filter-type" name="duration_value_type" value="<?php echo esc_attr($duration_field['duration_type']) ;?>">

			        	     		<label for="duration-filter-<?php echo esc_attr($k) ;?>">
										<span class="duration-name">
											<?php echo esc_html( $duration_field['duration_name']) ; ?>
										</span>
									</label>
		                		</div>
		                	<?php endforeach; endif;?>
		        	    </div>
		        	<?php endif; ?>
	        	</div>
	        </div>
		<?php endif; ?>
	    <?php endif; ?>

	    <!-- Filter -->
		<?php if ( $show_filter === 'yes') : ?>
	        <div class="ovabrw-tour-filter">
	        	
	        	<div class="left-filter">
	        		<span class="tour-found-text number-result-tour-found">
		        		<?php echo esc_html__( '0', 'ova-brw' ); ?>
		        	</span>
	        		<span class="tour-found-text">
		        		<?php echo esc_html( $tour_found_text ); ?>
		        	</span>
		        	<span class="clear-filter">
		        		<?php echo esc_html( $clear_filter_text ); ?>
		        	</span>
	        	</div>

	        	<div class="right-filter">
	        		<div class="filter-sort">

	        			<input type="text" class="input_select_input" name="sr_sort_by_label" value="<?php echo esc_html__('Sort by','ova-brw'); ?>" autocomplete="off" readonly="readonly">

						<input type="hidden" class="input_select_input_value" name="sr_sort_by" value="id_desc">

						<ul class="input_select_list" style="display: none;">
						    <li class="term_item <?php if( $sort_by_default == 'id_desc' ) { echo 'term_item_selected' ; } ?>" 
						    	data-id="id_desc" 
						    	data-value="<?php esc_attr_e('Sort by latest','ova-brw'); ?>"
						    >
							    <?php echo esc_html__('Latest','ova-brw'); ?>
							</li>
							<li class="term_item <?php if( $sort_by_default == 'rating_desc' ) { echo 'term_item_selected' ; } ?>" 
								data-id="rating_desc" 
								data-value="<?php esc_attr_e('Sort by rating','ova-brw'); ?>"
							>
								<?php echo esc_html__('Rating','ova-brw'); ?>
							</li>
							<li class="term_item <?php if( $sort_by_default == 'price_asc' ) { echo 'term_item_selected' ; } ?>" 
								data-id="price_asc" 
								data-value="<?php esc_attr_e('Sort by price: low to high','ova-brw'); ?>"
							>
								<?php echo esc_html__('Price: low to high','ova-brw'); ?>
							</li>
							<li class="term_item <?php if( $sort_by_default == 'price_desc' ) { echo 'term_item_selected' ; } ?>" 
								data-id="price_desc" 
								data-value="<?php esc_attr_e('Sort by price: high to low','ova-brw'); ?>"
							>
								<?php echo esc_html__('Price: high to low','ova-brw'); ?>
							</li>
						</ul>
					</div>

					<div class="asc_desc_sort">
	        			<i aria-hidden="true" class="asc_sort icomoon icomoon-chevron-up"></i>
	        		    <i aria-hidden="true" class="desc_sort icomoon icomoon-chevron-down"></i>
	        		</div>

	        		<div class="filter-result-layout">
		        		<i aria-hidden="true" class="filter-layout <?php if( $search_results_layout == 'list' )  { echo 'filter-layout-active' ; } ?> icomoon icomoon-list" data-layout="list"></i>
						<i aria-hidden="true" class="filter-layout <?php if( $search_results_layout == 'grid' )  { echo 'filter-layout-active' ; } ?> icomoon icomoon-gird" data-layout="grid"></i>
					</div>
	         	</div>	
	        </div>
	    <?php endif; ?>

		<!-- Load more -->
		<div class="wrap-load-more" style="display: none;">
			<svg class="loader" width="50" height="50">
				<circle cx="25" cy="25" r="10" />
				<circle cx="25" cy="25" r="20" />
			</svg>
		</div>
		<!-- End load more -->

		<!-- Search result -->
		<?php if ( $show_filter === 'yes' ): ?>
			<?php if ( $sort_by_default == 'id_desc' ): ?>
				<div 
					id="brw-search-ajax-result" 
					class="brw-search-ajax-result" 
					data-order="DESC" 
					data-orderby="ID" 
					data-defautl-category="<?php echo esc_attr( json_encode( $defautl_category ) ); ?>" 
					data-show-category="<?php echo esc_attr( $show_category ); ?>" 
					data-orderby_meta_key="" 
					data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>">
				</div>
			<?php elseif ( $sort_by_default == 'rating_desc' ): ?>
	            <div 
					id="brw-search-ajax-result" 
					class="brw-search-ajax-result" 
					data-order="DESC" 
					data-defautl-category="<?php echo esc_attr( json_encode( $defautl_category ) ); ?>" 
					data-show-category="<?php echo esc_attr( $show_category ); ?>" 
					data-orderby="meta_value_num"
					data-orderby_meta_key="_wc_average_rating" 
					data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>">
				</div>
			<?php elseif ( $sort_by_default == 'price_asc' ): ?>
	            <div 
					id="brw-search-ajax-result" 
					class="brw-search-ajax-result" 
					data-order="ASC" 
					data-orderby="meta_value_num" 
					data-defautl-category="<?php echo esc_attr( json_encode( $defautl_category ) ); ?>" 
					data-show-category="<?php echo esc_attr( $show_category ); ?>" 
					data-orderby_meta_key="_price" 
					data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>">
				</div>
			<?php elseif ( $sort_by_default == 'price_desc' ): ?>
	            <div 
					id="brw-search-ajax-result" 
					class="brw-search-ajax-result" 
					data-order="DESC" 
					data-defautl-category="<?php echo esc_attr( json_encode( $defautl_category ) ); ?>" 
					data-show-category="<?php echo esc_attr( $show_category ); ?>" 
					data-orderby="meta_value_num"
					data-orderby_meta_key="_price" 
					data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>">
				</div>
			<?php endif; ?>
		<?php else: ?>
			<div 
				id="brw-search-ajax-result" 
				class="brw-search-ajax-result" 
				data-order="<?php echo esc_attr( $order ); ?>" 
				data-defautl-category="<?php echo esc_attr( json_encode( $defautl_category ) ); ?>" 
				data-show-category="<?php echo esc_attr( $show_category ); ?>" 
				data-orderby="<?php echo esc_attr( $orderby ); ?>"
				data-orderby_meta_key="" 
				data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>">
			</div>
		<?php endif; ?>
    </div>
</div>