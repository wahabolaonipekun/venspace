<?php
	if(defined('TRIPGO_URL') 	== false) 	define('TRIPGO_URL', get_template_directory());
	if(defined('TRIPGO_URI') 	== false) 	define('TRIPGO_URI', get_template_directory_uri());

	load_theme_textdomain( 'tripgo', TRIPGO_URL . '/languages' );

	// Main Feature
	require_once( TRIPGO_URL.'/inc/class-main.php' );

	// Functions
	require_once( TRIPGO_URL.'/inc/functions.php' );

	// Hooks
	require_once( TRIPGO_URL.'/inc/class-hook.php' );

	// Widget
	require_once (TRIPGO_URL.'/inc/class-widgets.php');
	

	// Elementor
	if (defined('ELEMENTOR_VERSION')) {
		require_once (TRIPGO_URL.'/inc/class-elementor.php');
	}
	
	// WooCommerce
	if (class_exists('WooCommerce')) {
		require_once (TRIPGO_URL.'/inc/class-woo.php');
		require_once (TRIPGO_URL.'/inc/class-woo-template-functions.php');
		require_once (TRIPGO_URL.'/inc/class-woo-template-hooks.php');
	}
	
	
	/* Customize */
	if( current_user_can('customize') ){
	    require_once TRIPGO_URL.'/customize/custom-control/google-font.php';
	    require_once TRIPGO_URL.'/customize/custom-control/heading.php';
	    require_once TRIPGO_URL.'/inc/class-customize.php';
	}
    
   
	require_once ( TRIPGO_URL.'/install-resource/active-plugins.php' );
	

	
add_action('wp_head', 'load_script_for_header',99);
function load_script_for_header(){
	ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Slick Carousel JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<?php
	$content = ob_get_clean();
	echo $content;
}	

function extended_login_form(){
	load_template( TRIPGO_URL . '/template-parts/login.php'); 
}
add_action('extented_login_form', 'extended_login_form');

function extented_signup_form(){
	load_template( TRIPGO_URL . '/template-parts/signup.php'); 
}
add_action('extented_signup_form', 'extented_signup_form');

function change_privacy_policy_content($text, $type){
	return sprintf(__('<p class="vs-text-align-c"> By clicking Sign Up, you agree to Venspace services agreement and %s.</p>', 'venspace'), '[privacy_policy]');
}
add_filter( 'woocommerce_get_privacy_policy_text', 'change_privacy_policy_content', 10, 2 );
add_action( 'user_register', function ( $user_id ) {
	$user_info = get_userdata($user_id);
    $userdata = array();
    $userdata['ID'] = $user_id;
    $userdata['vs_validate_user'] = 'false';
	$userdata['vs_registration_completion'] = 'false';
    wp_update_user( $userdata );
	$message = 'The activation code is '.
	wp_mail( $user_info->user_login, 'Verify your email address', $message, $headers, $attachments );

});