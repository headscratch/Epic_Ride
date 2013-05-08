<?php
/**
* Google Fonts Implementation
*/

/**
* Register Google Fonts
*/
function organic_register_fonts() {
$protocol = is_ssl() ? 'https' : 'http';
wp_register_style( 'oswald', "$protocol://fonts.googleapis.com/css?family=Oswald:400,700,300" );
wp_register_style( 'merriweather', "$protocol://fonts.googleapis.com/css?family=Merriweather:400,700,300,900" );
}
add_action( 'init', 'organic_register_fonts' );

/**
* Enqueue Google Fonts on Front End
*/

function organic_fonts() {
wp_enqueue_style( 'oswald' );
wp_enqueue_style( 'merriweather' );
}
add_action( 'wp_enqueue_scripts', 'organic_fonts' );

/**
* Enqueue Google Fonts on Custom Header Page
*/
function organic_admin_fonts( $hook_suffix ) {
if ( 'appearance_page_custom-header' != $hook_suffix )
return;

wp_enqueue_style( 'oswald' );
wp_enqueue_style( 'merriweather' );
}
add_action( 'admin_enqueue_scripts', 'organic_admin_fonts' );