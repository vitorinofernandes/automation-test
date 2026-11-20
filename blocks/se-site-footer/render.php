<?php
/**
 * SE Site footer (Figma "10 Footer", 230:3724).
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a     = $attributes;
$home  = ! empty( $a['homeUrl'] ) ? $a['homeUrl'] : home_url( '/' );
$logo  = se_asset_url( $a['logoImage'] ?? '' );
$icons = get_theme_file_uri( 'assets/icons' );

$social_icons = array(
	'facebook'  => array( 'facebook.svg', 'Facebook' ),
	'instagram' => array( 'instagram.svg', 'Instagram' ),
	'linkedin'  => array( 'linkedin.svg', 'LinkedIn' ),
);

$columns = array(
	array( 'class' => 'se-footer__frame-30', 'figma' => '230:3733', 'title' => $a['servicesTitle'] ?? '', 'links' => $a['servicesLinks'] ?? array() ),
	array( 'class' => 'se-footer__frame-47', 'figma' => '230:3741', 'title' => $a['shortcutsTitle'] ?? '', 'links' => $a['shortcutsLinks'] ?? array() ),
);

$contact = array(
	array( 'figma' => '230:3751', 'icon' => 'frame-2303752.svg', 'text' => $a['address'] ?? '', 'url' => $a['addressUrl'] ?? '' ),
	array( 'figma' => '230:3755', 'icon' => 'frame-2303756.svg', 'text' => $a['phone'] ?? '', 'url' => $a['phoneUrl'] ?? '' ),
	array( 'figma' => '230:3759', 'icon' => 'frame-2303760.svg', 'text' => $a['email'] ?? '', 'url' => $a['emailUrl'] ?? '' ),
	array( 'figma' => '230:3763', 'icon' => 'frame-2303764.svg', 'text' => $a['hours'] ?? '', 'url' => '' ),
);
?>
<section class="se-footer" data-figma="230:3724">
<div class="se-footer__frame-53" data-figma="230:3725">
<div class="se-footer__frame-46" data-figma="230:3726">
<a class="se-footer__image-7" data-figma="230:3727" href="<?php echo esc_url( $home ); ?>">
<?php if ( $logo ) : ?>
<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $a['logoAlt'] ?? '' ); ?>">
<?php else : ?>
<span class="se-footer__link"><?php echo esc_html( $a['logoAlt'] ?? '' ); ?></span>
<?php endif; ?>
</a>
<?php if ( ! empty( $a['text'] ) ) : ?>
<p class="se-footer__safe-modern-and-reliable" data-figma="230:3728"><?php echo esc_html( $a['text'] ); ?></p>
<?php endif; ?>
<?php if ( ! empty( $a['social'] ) ) : ?>
<div class="se-footer__frame-40" data-figma="230:3729">
<?php foreach ( (array) $a['social'] as $s ) : ?>
<?php
$key = strtolower( trim( (string) ( $s['network'] ?? '' ) ) );
if ( ! isset( $social_icons[ $key ] ) ) {
	continue;
}
?>
<a href="<?php echo esc_url( $s['url'] ?? '#' ); ?>" aria-label="<?php echo esc_attr( $social_icons[ $key ][1] ); ?>" target="_blank" rel="noopener"><img src="<?php echo esc_url( $icons . '/' . $social_icons[ $key ][0] ); ?>" alt=""></a>
<?php endforeach; ?>
</div>
<?php endif; ?>
</div>
<?php foreach ( $columns as $col ) : ?>
<div class="<?php echo esc_attr( $col['class'] ); ?>" data-figma="<?php echo esc_attr( $col['figma'] ); ?>">
<?php if ( '' !== $col['title'] ) : ?>
<p class="se-footer__heading"><?php echo esc_html( $col['title'] ); ?></p>
<?php endif; ?>
<?php foreach ( (array) $col['links'] as $link ) : ?>
<?php if ( empty( $link['label'] ) ) { continue; } ?>
<a class="se-footer__link" href="<?php echo esc_url( $link['url'] ?? '#' ); ?>"><?php echo esc_html( $link['label'] ); ?></a>
<?php endforeach; ?>
</div>
<?php endforeach; ?>
<div class="se-footer__frame-48" data-figma="230:3749">
<?php if ( ! empty( $a['contactTitle'] ) ) : ?>
<p class="se-footer__heading" data-figma="230:3750"><?php echo esc_html( $a['contactTitle'] ); ?></p>
<?php endif; ?>
<?php foreach ( $contact as $row ) : ?>
<?php
if ( '' === trim( (string) $row['text'] ) ) {
	continue;
}
$tag = '' !== $row['url'] ? 'a' : 'div';
?>
<<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput ?> class="se-footer__contact-row" data-figma="<?php echo esc_attr( $row['figma'] ); ?>"<?php echo 'a' === $tag ? ' href="' . esc_url( $row['url'] ) . '"' : ''; ?>>
<img class="se-footer__icon" src="<?php echo esc_url( $icons . '/' . $row['icon'] ); ?>" alt="">
<span class="se-footer__contact-text"><?php echo se_text( $row['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
</<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
<?php endforeach; ?>
</div>
</div>
<div class="se-footer__line-15" data-figma="230:3767" aria-hidden="true"></div>
<div class="se-footer__frame-32" data-figma="230:3768">
<div class="se-footer__frame-1984081059" data-figma="230:3769">
<?php if ( ! empty( $a['copyright'] ) ) : ?>
<p class="se-footer__legal" data-figma="230:3770"><?php echo esc_html( $a['copyright'] ); ?></p>
<?php endif; ?>
<?php if ( ! empty( $a['orgText'] ) ) : ?>
<p class="se-footer__legal se-footer__org" data-figma="230:3771"><?php echo esc_html( $a['orgText'] ); ?></p>
<?php endif; ?>
<?php foreach ( (array) ( $a['legalLinks'] ?? array() ) as $link ) : ?>
<?php if ( empty( $link['label'] ) ) { continue; } ?>
<a class="se-footer__legal" href="<?php echo esc_url( $link['url'] ?? '#' ); ?>"><?php echo esc_html( $link['label'] ); ?></a>
<?php endforeach; ?>
<?php if ( ! empty( $a['credit'] ) ) : ?>
<?php if ( ! empty( $a['creditUrl'] ) ) : ?>
<a class="se-footer__legal" data-figma="230:3774" href="<?php echo esc_url( $a['creditUrl'] ); ?>"><?php echo esc_html( $a['credit'] ); ?></a>
<?php else : ?>
<p class="se-footer__legal" data-figma="230:3774"><?php echo esc_html( $a['credit'] ); ?></p>
<?php endif; ?>
<?php endif; ?>
</div>
</div>
</section>
