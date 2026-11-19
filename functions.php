<?php
/**
 * Stavanger Elektro theme functions.
 *
 * @package stavanger-elektro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SE_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Theme setup.
 */
function se_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_editor_style( 'style.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'stavanger-elektro' ),
			'footer'  => __( 'Footer menu', 'stavanger-elektro' ),
		)
	);
}
add_action( 'after_setup_theme', 'se_theme_setup' );

/**
 * Front-end styles. Fonts are self-hosted and declared in theme.json.
 */
function se_enqueue_assets() {
	wp_enqueue_style( 'stavanger-elektro', get_stylesheet_uri(), array(), SE_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'se_enqueue_assets' );
