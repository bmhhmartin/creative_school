<?php
/**
 * @package VW One Page
 * Setup the WordPress core custom header feature.
 *
 * @uses vw_one_page_header_style()
*/
function vw_one_page_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'vw_one_page_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'vw_one_page_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'vw_one_page_custom_header_setup' );

if ( ! function_exists( 'vw_one_page_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see vw_one_page_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'vw_one_page_header_style' );
function vw_one_page_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        .home-page-header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'vw-one-page-basic-style', $custom_css );
	endif;
}
endif; // vw_one_page_header_style