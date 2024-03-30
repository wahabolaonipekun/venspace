<?php if ( !defined( 'ABSPATH' ) ) exit(); 

if( isset( $args['id'] ) ){
	$id = $args['id'];
}else{
	$id = get_the_id();	
}


?>

<div class="event-thumbnail-v2">	

	<a href="<?php echo get_the_permalink( $id ); ?>">
		<?php echo get_the_post_thumbnail( $id, 'ovaev_event_thumbnail' ); ?>
	</a>

</div>