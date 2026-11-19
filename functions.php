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

/**
 * Block styles (front end and editor) and the shared front-end script.
 */
function se_enqueue_block_assets() {
	wp_enqueue_style( 'se-blocks', get_theme_file_uri( 'assets/css/blocks.css' ), array( 'stavanger-elektro' ), SE_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'se_enqueue_block_assets', 20 );

function se_enqueue_view_script() {
	wp_enqueue_script( 'se-blocks', get_theme_file_uri( 'assets/js/se-blocks.js' ), array(), SE_THEME_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'se_enqueue_view_script' );

/**
 * Editor: block styles plus the generic sidebar editor for the se/* blocks.
 */
function se_enqueue_editor_assets() {
	wp_enqueue_script(
		'se-editor',
		get_theme_file_uri( 'assets/js/se-editor.js' ),
		array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-server-side-render', 'wp-hooks' ),
		SE_THEME_VERSION,
		true
	);

	// The se/* blocks are registered in PHP (block.json + render.php). The editor only knows a block
	// that is also registered in JavaScript, so se-editor.js registers each one from this list.
	$blocks = array();
	foreach ( glob( get_theme_file_path( 'blocks/*/block.json' ) ) as $file ) {
		$meta = wp_json_file_decode( $file, array( 'associative' => true ) );
		if ( empty( $meta['name'] ) ) {
			continue;
		}
		$blocks[ $meta['name'] ] = array(
			'title'       => $meta['title'] ?? $meta['name'],
			'description' => $meta['description'] ?? '',
			'category'    => $meta['category'] ?? 'design',
			'icon'        => $meta['icon'] ?? 'layout',
			'attributes'  => $meta['attributes'] ?? array(),
		);
	}
	wp_add_inline_script( 'se-editor', 'window.seBlocks = ' . wp_json_encode( $blocks ) . ';', 'before' );
}
add_action( 'enqueue_block_editor_assets', 'se_enqueue_editor_assets' );

function se_editor_block_styles() {
	add_editor_style( 'assets/css/blocks.css' );
}
add_action( 'after_setup_theme', 'se_editor_block_styles', 20 );

/**
 * Register every block in blocks/<name>/block.json.
 */
function se_register_blocks() {
	foreach ( glob( get_theme_file_path( 'blocks/*/block.json' ) ) as $file ) {
		register_block_type( dirname( $file ) );
	}
}
add_action( 'init', 'se_register_blocks' );

/* Render helpers */
function se_text( $s ) {
	return nl2br( esc_html( (string) $s ) );
}

/**
 * Full URLs pass through; a theme-relative path (e.g. assets/illustrations/x.svg)
 * becomes its theme URL, or '' when the file is not in the theme.
 */
function se_asset_url( $url ) {
	$url = trim( (string) $url );
	if ( '' === $url || preg_match( '#^([a-z][a-z0-9+.-]*:|/)#i', $url ) ) {
		return $url;
	}
	return file_exists( get_theme_file_path( $url ) ) ? get_theme_file_uri( $url ) : '';
}

function se_media_img( $url, $alt = '', $class = '' ) {
	$url = se_asset_url( $url );
	if ( $url ) {
		return '<img class="' . esc_attr( $class ) . '" src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy" />';
	}
	return '<span class="se-ph ' . esc_attr( $class ) . '" aria-hidden="true"></span>';
}

function se_lines( $s ) {
	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $s ) ) ) );
}
