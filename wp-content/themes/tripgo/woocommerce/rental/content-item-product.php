<?php
/**
 * @package    Tripgo by ovatheme
 * @author     Ovatheme
 * @copyright  Copyright (C) 2022 Ovatheme All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( !defined( 'ABSPATH' ) ) exit();

$product_id = isset( $args['id'] ) && $args['id'] ? $args['id'] : get_the_id();
$product 	= wc_get_product( $product_id );

$date_format 	= ovabrw_get_date_format();

$min_adults     = get_post_meta( $product_id, 'ovabrw_adults_min', true );
$min_childrens  = get_post_meta( $product_id, 'ovabrw_childrens_min', true );
if ( !$min_adults ) $min_adults = 1;
if ( !$min_childrens ) $min_childrens = 0;

// thumbnail
$link      	= apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
$param      = array();

global $_POST;

$clicked 		= isset( $_POST['clicked'] ) 		? $_POST['clicked'] 		: '';
$start_date 	= isset( $_POST['start_date'] ) ? $_POST['start_date'] 	: '';
$adults 		= isset( $_POST['adults'] ) 	? $_POST['adults'] 		: $min_adults;
$childrens 		= isset( $_POST['childrens'] ) 	? $_POST['childrens'] 	: $min_childrens;

$dropoff_date 	= '';

if ( $clicked  ) {
	if ( $start_date ) {
		$param['pickup_date'] 	= $start_date;
		$day 					= get_post_meta( $product_id, 'ovabrw_number_days', true );
		$dropoff_date 			= strtotime( $start_date ) + $day*86400;
		$dropoff_date 		  	= date_i18n( $date_format, $dropoff_date );
	}

	if ( $dropoff_date ) {
		$param['dropoff_date']  = $dropoff_date;
	}

	if ( $adults ) {
		$param['ovabrw_adults'] = $adults;
	}

	if ( $childrens ) {
		$param['ovabrw_childrens'] = $childrens;
	}

	if ( $param ) {
		$link = add_query_arg( $param, $link );
	}
}

// tour days and hours
$tour_day  	= get_post_meta ( $product_id,'ovabrw_number_days', true );
$tour_hour  = get_post_meta ( $product_id,'ovabrw_number_hours', true );
$duration 	= get_post_meta ( $product_id,'ovabrw_duration_checkbox', true );

// location and review
$address        = get_post_meta( $product_id, 'ovabrw_address', true );
$review_count   = $product->get_review_count();
$rating         = $product->get_average_rating();

// Wishlist
$wishlist = do_shortcode('[yith_wcwl_add_to_wishlist]');

// Featured product
$is_featured = $product->is_featured();

// Price
$regular_price = $product->get_regular_price();

if ( $product->is_on_sale() ) {
    $sale_price = $product->get_sale_price();
}
// Max people
$max_people 		= '';
$max_total_guest 	= get_post_meta( $product_id, 'ovabrw_max_total_guest', true );

if ( absint( $max_total_guest ) ) {
	$max_people = absint( $max_total_guest );
} else {
	$max_people = absint( get_post_meta( $product_id, 'ovabrw_adults_max', true ) );

	if ( get_option( 'ova_brw_booking_form_show_children', 'yes' ) === 'yes' ) {
		$max_people += absint( get_post_meta( $product_id, 'ovabrw_childrens_max', true ) );
	}
	if ( get_option( 'ova_brw_booking_form_show_baby', 'yes' ) === 'yes' ) {
		$max_people += absint( get_post_meta( $product_id, 'ovabrw_babies_max', true ) );
	}
}
?>

<div class="ova_head_product">
	<?php if ( $is_featured ): ?>
		<div class="ova-is-featured">
			<?php esc_html_e( 'Featured', 'tripgo' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( '[yith_wcwl_add_to_wishlist]' != $wishlist ): ?>
		<div class="ova-product-wishlist">
			<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
		</div>
	<?php endif; ?>
	<?php if ( apply_filters( 'ovabrw_ft_product_list_card_gallery', false ) ): ?>
		<div class="ova-card-gallery">
			<?php
				$data_options = apply_filters( 'ft_wc_card_gallery_slideshow_options', array(
			        'items'                 => 1,
			        'slideBy'               => 1,
			        'margin'                => 24,
			        'autoplayHoverPause'    => true,
			        'loop'                  => true,
			        'autoplay'              => false,
			        'autoplayTimeout'       => 3000,
			        'smartSpeed'            => 500,
			        'autoWidth'             => false,
			        'center'                => false,
			        'lazyLoad'              => true,
			        'dots'                  => true,
			        'nav'                   => true,
			        'rtl'                   => is_rtl() ? true: false,
			        'nav_left'              => 'icomoon icomoon-angle-left',
			        'nav_right'             => 'icomoon icomoon-angle-right',
			    ));
			?>
			<?php wc_get_template( 'rental/loop/gallery-slideshow.php', [ 'data_options' => $data_options ] ); ?>
		</div>
	<?php else: ?>
		<a href="<?php echo esc_url( $link ); ?>" class="ova-product-thumbnail">
			<?php echo woocommerce_get_product_thumbnail('tripgo_product_slider'); ?>
		</a>
	<?php endif; ?>
</div>
<div class="ova_foot_product">
	<div class="ova-product-day-title-location">
			<?php if ( ( $tour_day || $tour_hour ) && $product->is_type( 'ovabrw_car_rental' ) ) :?>
				
					<?php if ( $duration ):
						$hours 		= ovabrw_convert_number_to_hours( $tour_hour );
						$minutes 	= ovabrw_convert_number_to_minutes( $tour_hour );
					?>
						<?php if ( $hours && $minutes ): ?>
							<?php if ( $hours > 1 && $minutes > 1 ): ?>
								<?php $period = ($hours + ($minutes / 60)).'hrs'; ?>
								<?php $get_period = esc_html__( $hours.' hrs '.$minutes.' minutes', 'tripgo' ); ?>
							<?php elseif ( $hours == 1 && $minutes > 1 ): ?>
								<?php $period = (($hours + ($minutes / 60))*12).'hrs'; ?>
								<?php $get_period = esc_html__($hours.' hr '.$minutes.' minutes', 'tripgo' ); ?>
							<?php elseif ( $hours > 1 && $minutes == 1 ): ?>
								<?php $period = (($hours + ($minutes / 60))*12).'hrs'; ?>
								<?php $get_period = esc_html__( $hours.' hrs '.$minutes.' minute', 'tripgo' ); ?>
							<?php else: ?>
								<?php $period = (($hours + ($minutes / 60))*12).'hrs'; ?>
								<?php $get_period = esc_html__( $hours.' hr '.$minutes.' minute', 'tripgo' ); ?>
							<?php endif; ?>
						<?php elseif ( ! $hours && $minutes ): ?>
							<?php if ( $minutes == 1 ): ?>
								<?php $periodMin = (($minutes * 60)*12).'hrs'; ?>
								<?php $get_period = esc_html__( $minutes.' min', 'tripgo' ); ?>
							<?php else: ?>
							<?php $periodCon = $minutes / 60; $period = ($periodCon * 12).'hrs';?>
								<?php $get_period = esc_html__( $minutes . ' mins', 'tripgo' ); ?>
							<?php endif; ?>
						<?php else: ?>
							<?php if ( $hours == 1 ): ?>
								<?php $period = ($hours * 12).'hrs';?>
								<?php $get_period = esc_html__( $hours.' hr', 'tripgo' ); ?>
							<?php else: ?>
								<?php $period = ($hours * 12).'hrs';?>
								<?php $get_period = esc_html__( $hours .' hrs', 'tripgo' ); ?>
							<?php endif; ?>
						<?php endif; ?>
					<?php else: ?>
						<?php if ( absint( $tour_day ) == 1 ): ?>
							<?php $period = ($tour_day * 12).'days';?>
							<?php $get_period = esc_html( $tour_day ) . ' ' . esc_html__('day','tripgo'); ?>
						<?php else: ?>
							<?php $period = ($tour_day * 12).'days';?>
							<?php $get_period = esc_html( $tour_day ) . ' ' . esc_html__('days','tripgo'); ?>
						<?php endif; ?>
					<?php endif; ?>
			<?php endif;?>
		<h2 class="ova-product-title">
			<a href="<?php echo esc_url( $link ); ?>">
		        <?php echo get_the_title(); ?>
		    </a>
		</h2>
		<?php if ( $address ): ?>
	        <div class="ova-product-location">
	            <i aria-hidden="true" class="icomoon icomoon-location"></i>
	            <span class="location">
	                <?php echo esc_html( $address ); ?>
	            </span>
	        </div>
	    <?php endif; ?>
			<div class="vs-flex vs-a-item-center vs-fs-10">
			<?php if ( ! empty( $max_people ) ) : ?>
				<div class="ova-max-people vs-pd-right-10">
					<i aria-hidden="true" class="icomoon icomoon-profile-circle"></i>
					<?php echo esc_html( $max_people ) ;?> People	
				</div>
			<?php endif;?>
				
			<?php if ( wc_review_ratings_enabled() && $rating > 0 ): ?>
		        <div class="ova-product-review vs-mg-right-5 ven-d-contents">
		            <div class="star-rating" role="img" aria-label="<?php echo sprintf( __( 'Rated %s out of 5', 'tripgo' ), $rating ); ?>">
		                <span class="rating-percent" style="width: <?php echo esc_attr( ( $rating / 5 ) * 100 ).'%'; ?>;"></span>
		            </div>
					<div class="vs-pd-right-5">
					<?php echo ( $rating / 5 ) * 10 ;?>
					</div>
		            <a href="<?php echo esc_url($link); ?>#reviews" class="woo-review-link vs-pd-left-5" rel="nofollow">(
		                <?php printf( _n( '%s review', '%s reviews', $review_count, 'tripgo' ), esc_html( $review_count ) ); ?>)
		            </a>
		        </div>
		    <?php endif; ?>
			</div>
<!--     <div class="ova-product-review-and-price"> -->
		<div class="ova-product-wrapper-price">
				
				<?php $respond = get_post_meta($post->ID, 'responds_time', true);
				$currency_symbol = get_woocommerce_currency_symbol( $currency );
				?>
				<div class="vs-mg-autos">
					<div class="ova-product-price">
					<?php if ( isset( $sale_price ) && $regular_price ): ?>
						<span class="new-product-price vs-fw-700"><?php echo wc_price( $sale_price ); ?></span>
						<span class="old-product-price"><del><?php echo wc_price( $regular_price ); ?></del></span>
						<div class="">
							<?php
							// Assuming $regular_price is the regular price variable
							$numeric_price = wc_format_decimal(wc_clean($sale_price));
							$result = $numeric_price * 12;
							//$updated_price = wc_price($updated_price_value);

							?>
							<span class="calculated-price"><?php echo  $currency_symbol.$result;?> total </span>
							<?php if ( ( $tour_day || $tour_hour ) && $product->is_type( 'ovabrw_car_rental' ) ) :?>
								<span>/ <?php echo $period; ?></span>
							<?php endif; ?>
						</div>
					<?php elseif ( ! isset( $sale_price ) && $regular_price ): ?>
						<?php
						$regular_price_value = wc_get_price_decimals() > 0 ? wc_format_decimal(wc_get_price_to_display($product, array('price' => $regular_price)), wc_get_price_decimals()) : wc_get_price_to_display($product, array('price' => $regular_price));

						// Multiply by 12
						 $updated_price_value = $regular_price_value * 12; $formatted_price = number_format($updated_price_value,2);
						?>
						<span class="new-product-price vs-fw-700"><?php echo wc_price( $regular_price ); ?></span>
						<?php if ( ( $tour_day || $tour_hour ) && $product->is_type( 'ovabrw_car_rental' ) ) :?>
							<span>/ <?php echo $get_period; ?></span>
						<?php endif; ?>
						<div class="">
							<span class="calculated-price"><?php echo $currency_symbol .$formatted_price; ?> total</span>
							<?php if ( ( $tour_day || $tour_hour ) && $product->is_type( 'ovabrw_car_rental' ) ) :?>
								<span>/ <?php echo $period; ?></span>
							<?php endif; ?>
						</div>
				    <?php else: ?>
				    	<?php if ( ! $product || ! $product->is_type('ovabrw_car_rental') ): ?>
				    		<span class="new-product-price"><?php echo $product->get_price_html(); ?></span>
							<?php if ( ( $tour_day || $tour_hour ) && $product->is_type( 'ovabrw_car_rental' ) ) :?>
								<span>/ <?php echo $get_period; ?></span>
							<?php endif; ?>
							<div class="">
								<span class="calculated-price"><?php //echo ($product->get_price_html() x 12); ?> total</span>
								<?php if ( ( $tour_day || $tour_hour ) && $product->is_type( 'ovabrw_car_rental' ) ) :?>
									<span>/ <?php echo $period; ?></span>
								<?php endif; ?>
							</div>
				    	<?php else: ?>
				    		<span class="no-product-price"><?php esc_html_e( 'Option Price', 'tripgo' ); ?></span>
				    	<?php endif; ?>
					<?php endif; ?>
					</div>
					
				</div>
			</div>

    </div>

</div>