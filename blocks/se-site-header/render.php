<?php
/**
 * SE Site header (Figma "Nav", 230:3055).
 *
 * Transparent and over the first section when the page starts with a full-width
 * section block; solid dark green and in the page flow everywhere else.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'se_header_overlays_page' ) ) {
	/**
	 * True when the current singular page starts with a full-width section block.
	 */
	function se_header_overlays_page() {
		if ( ! function_exists( 'is_singular' ) || ! is_singular() ) {
			return false;
		}
		$post = get_queried_object();
		if ( ! $post instanceof WP_Post || '' === $post->post_content ) {
			return false;
		}
		$full_width = apply_filters( 'se_header_overlay_blocks', array( 'se/hero', 'se/stats', 'se/testimonial', 'se/reels', 'se/contact' ) );
		foreach ( parse_blocks( $post->post_content ) as $block ) {
			if ( empty( $block['blockName'] ) ) {
				continue;
			}
			return in_array( $block['blockName'], $full_width, true );
		}
		return false;
	}
}

$a     = $attributes;
$style = $a['headerStyle'] ?? 'auto';
if ( 'auto' === $style ) {
	$style = se_header_overlays_page() ? 'overlay' : 'solid';
}
$home    = ! empty( $a['homeUrl'] ) ? $a['homeUrl'] : home_url( '/' );
$logo    = se_asset_url( $a['logoImage'] ?? '' );
$menu_id = wp_unique_id( 'se-header-menu-' );
$icons   = get_theme_file_uri( 'assets/icons' );
?>
<section class="se-header se-header--<?php echo esc_attr( $style ); ?>" data-figma="230:3055-band" data-se-header>
<div class="se-header__nav" data-figma="230:3055">
<a class="se-header__home" href="<?php echo esc_url( $home ); ?>">
<?php if ( $logo ) : ?>
<img class="se-header__logo-white" data-figma="230:3056" src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $a['logoAlt'] ?? '' ); ?>">
<?php else : ?>
<span class="se-header__logo-text"><?php echo esc_html( $a['logoAlt'] ?? '' ); ?></span>
<?php endif; ?>
</a>
<nav class="se-header__frame" id="<?php echo esc_attr( $menu_id ); ?>" data-figma="230:3077" aria-label="<?php esc_attr_e( 'Main menu', 'stavanger-elektro' ); ?>">
<?php foreach ( (array) ( $a['menu'] ?? array() ) as $item ) : ?>
<?php if ( empty( $item['label'] ) ) { continue; } ?>
<a class="se-header__link" href="<?php echo esc_url( $item['url'] ?? '#' ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
<?php endforeach; ?>
<?php if ( ! empty( $a['phone'] ) ) : ?>
<a class="se-header__panel-phone" href="<?php echo esc_url( $a['phoneUrl'] ?? '' ); ?>"><?php echo esc_html( $a['phone'] ); ?></a>
<?php endif; ?>
</nav>
<div class="se-header__frame-2" data-figma="230:3082">
<?php if ( ! empty( $a['phone'] ) ) : ?>
<a class="se-header__frame-3" data-figma="230:3083" href="<?php echo esc_url( $a['phoneUrl'] ?? '' ); ?>">
<img class="se-header__frame-4" data-figma="230:3084" src="<?php echo esc_url( $icons . '/frame-2303084.svg' ); ?>" alt="">
<span class="se-header__51-54-44-44" data-figma="230:3086"><?php echo esc_html( $a['phone'] ); ?></span>
</a>
<?php endif; ?>
<?php if ( ! empty( $a['buttonLabel'] ) ) : ?>
<a class="se-header__button-free-inspection" data-figma="230:3087" href="<?php echo esc_url( $a['buttonUrl'] ?? '#' ); ?>">
<span class="se-header__free-inspection" data-figma="230:3088"><?php echo esc_html( $a['buttonLabel'] ); ?></span>
<img class="se-header__frame-5" data-figma="230:3089" src="<?php echo esc_url( $icons . '/frame-2303089.svg' ); ?>" alt="">
</a>
<?php endif; ?>
<button class="se-header__toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $menu_id ); ?>" data-se-header-toggle>
<span class="se-header__toggle-bars" aria-hidden="true"><span></span><span></span><span></span></span>
<span class="screen-reader-text"><?php echo esc_html( $a['menuLabel'] ?? 'Menu' ); ?></span>
</button>
</div>
</div>
</section>
