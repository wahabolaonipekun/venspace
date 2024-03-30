<?php if ( !defined( 'ABSPATH' ) ) exit();

// Search Form action
add_action( 'ovaev_search_form', 'ovaev_search_form' );
function ovaev_search_form(){
    return ovaev_get_template( 'search_form.php' );
}

// Highlight date 1 action
add_action( 'ovaev_loop_highlight_date_1', 'ovaev_loop_highlight_date_1', 10, 1 );
function ovaev_loop_highlight_date_1( $id = '' ){
    return ovaev_get_template( 'loop/highlight_date_1.php', array( 'id' => $id ) );
}

// Highlight date 2 action
add_action( 'ovaev_loop_highlight_date_2', 'ovaev_loop_highlight_date_2', 10, 1 );
function ovaev_loop_highlight_date_2( $id = '' ){
    return ovaev_get_template( 'loop/highlight_date_2.php', array( 'id' => $id ) );
}

// Highlight date 3 action
add_action( 'ovaev_loop_highlight_date_3', 'ovaev_loop_highlight_date_3', 10, 1 );
function ovaev_loop_highlight_date_3( $id = '' ){
    return ovaev_get_template( 'loop/highlight_date_3.php', array( 'id' => $id ) );
}

// Thumbanil archive event list
add_action( 'ovaev_loop_thumbnail_list', 'ovaev_loop_thumbnail_list', 10, 1 );
function ovaev_loop_thumbnail_list( $id = '' ){
    return ovaev_get_template( 'loop/thumbnail_list.php', array( 'id' => $id ) );   
}

// Thumbanil archive event grid
add_action( 'ovaev_loop_thumbnail_grid', 'ovaev_loop_thumbnail_grid', 10, 1 );
function ovaev_loop_thumbnail_grid( $id = '' ){
    return ovaev_get_template( 'loop/thumbnail_grid.php', array( 'id' => $id ) );   
}

// Thumbanil archive event
add_action( 'ovaev_loop_thumbnail', 'ovaev_loop_thumbnail', 10, 1 );
function ovaev_loop_thumbnail( $id = '' ){
    return ovaev_get_template( 'loop/thumbnail.php', array( 'id' => $id ) );   
}

// Loop type action
add_action( 'ovaev_loop_type', 'ovaev_loop_type', 10, 1 );
function ovaev_loop_type( $id = '' ){
    return ovaev_get_template( 'loop/type.php', array( 'id' => $id ) );      
}

// Loop Title
add_action( 'ovaev_loop_title', 'ovaev_loop_title', 10, 1 );
function ovaev_loop_title( $id = '' ){
    return ovaev_get_template( 'loop/title.php', array( 'id' => $id ) );      
}

// Loop venue
add_action( 'ovaev_loop_venue', 'ovaev_loop_venue', 10, 1 );
function ovaev_loop_venue( $id = '' ){
    return ovaev_get_template( 'loop/venue.php', array( 'id' => $id ) );      
}

// Loop excerpt
add_action( 'ovaev_loop_excerpt', 'ovaev_loop_excerpt', 10, 1 );
function ovaev_loop_excerpt( $id = '' ){
    return ovaev_get_template( 'loop/excerpt.php', array( 'id' => $id ) );      
}

// Event date
add_action( 'ovaev_loop_date_event', 'ovaev_loop_date_event', 10, 1 );
function ovaev_loop_date_event( $id = '' ){
    return ovaev_get_template( 'loop/date_event.php', array( 'id' => $id ) );      
}

// Read more
add_action( 'ovaev_loop_readmore', 'ovaev_loop_readmore', 10, 1 );
function ovaev_loop_readmore( $id = '' ){
    return ovaev_get_template( 'loop/readmore.php', array( 'id' => $id ) );      
}

add_action( 'ovaev_loop_readmore_2', 'ovaev_loop_readmore_2', 10, 1 );
function ovaev_loop_readmore_2( $id = '' ){
    return ovaev_get_template( 'loop/readmore2.php', array( 'id' => $id ) );      
}

// Single Thumbnail
add_action( 'oavev_single_thumbnail', 'oavev_single_thumbnail' );
function oavev_single_thumbnail(){
    return ovaev_get_template( 'single/thumbnail.php' );
}

// Single Title
add_action( 'ovaev_single_title', 'ovaev_single_title' );
function ovaev_single_title(){
    return ovaev_get_template( 'single/title.php' );
}

// Single Time Location
add_action( 'oavev_single_time_loc', 'oavev_single_time_loc_date_time', 10 );
function oavev_single_time_loc_date_time(){
    return ovaev_get_template( 'single/time_loc_date_time.php' );
}

add_action( 'oavev_single_time_loc', 'oavev_single_time_loc_location', 20 );
function oavev_single_time_loc_location(){
    return ovaev_get_template( 'single/time_loc_location.php' );
}

// Single Taxonomy Type
add_action( 'oavev_single_type', 'oavev_single_type', 10 );
function oavev_single_type(){
    return ovaev_get_template( 'single/type.php' );
}

// Single Booking Links
add_action( 'oavev_single_booking_links', 'oavev_single_booking_links', 10 );
function oavev_single_booking_links(){
    return ovaev_get_template( 'single/booking_links.php' );
}

// Single Tags
add_action( 'oavev_single_tags', 'oavev_single_tags', 10 );
function oavev_single_tags(){
    return ovaev_get_template( 'single/tags.php' );
}

// Single Share
add_action( 'oavev_single_share', 'oavev_single_share', 10 );
function oavev_single_share(){
    return ovaev_get_template( 'single/share.php' );
}

add_action( 'oavev_single_related', 'oavev_single_related', 10 );
function oavev_single_related(){
    return ovaev_get_template( 'single/related.php' );
}

add_filter( 'ovaev_share_social', 'ovaev_content_social', 10, 2 );
function ovaev_content_social( $link, $title ) {
    $html = '<ul class="share-social-icons">
            
        <li><a class="share-ico ico-facebook" target="_blank" href="http://www.facebook.com/sharer.php?u='.$link.'"><i class="fab fa-facebook-square"></i></a></li>
        <li><a class="share-ico ico-twitter" target="_blank" href="https://twitter.com/share?url='.$link.'&amp;text='.urlencode($title).'"><i class="fab fa-twitter"></i></a></li>
        <li><a class="share-ico ico-pinterest" target="_blank" href="http://www.pinterest.com/pin/create/button/?url='.$link.'"><i class="fab fa-pinterest"></i></a></li>
        <li><a class="share-ico ico-linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url='.$link.'"><i class="fab fa-linkedin-in"></i></a></li>           
        
    </ul>';

    return apply_filters( 'ovaev_share_social_html', $html, $link, $title );
}

add_filter( 'tripgo_header_customize', 'tripgo_header_customize_event', 10, 1 );
function tripgo_header_customize_event( $header ){

    if( is_tax( 'event_category' ) ||  get_query_var( 'event_type' ) != '' || is_tax( 'event_tag' ) ||  get_query_var( 'event_tag' ) != '' || is_post_type_archive( 'event' ) ){

        $header = OVAEV_Settings::archive_event_header();

    }else if( is_singular( 'event' ) ){

        $header = OVAEV_Settings::single_event_header();
    }

    return $header;

}

add_filter( 'tripgo_footer_customize', 'tripgo_footer_customize_event', 10, 1 );
function tripgo_footer_customize_event( $footer ){
    
    if( is_tax( 'event_category' ) ||  get_query_var( 'event_type' ) != '' || is_tax( 'event_tag' ) ||  get_query_var( 'event_tag' ) != '' || is_post_type_archive( 'event' ) ){

        $footer = OVAEV_Settings::archive_event_footer();

    }else if( is_singular( 'event' ) ){

        $footer = OVAEV_Settings::single_event_footer();
    }

    return $footer;

}