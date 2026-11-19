<?php
/**
 * SE Hero.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a = $attributes;
?>
<section class="se-section se-hero">
	<?php if ( ! empty( $a['backgroundVideo'] ) ) : ?>
		<video class="se-hero__bg" src="<?php echo esc_url( $a['backgroundVideo'] ); ?>" poster="<?php echo esc_url( $a['posterImage'] ); ?>" autoplay muted loop playsinline aria-hidden="true"></video>
	<?php else : ?>
		<?php echo se_media_img( $a['posterImage'], '', 'se-hero__bg' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<?php endif; ?>
	<div class="se-inner se-hero__inner">
		<?php if ( ! empty( $a['eyebrow'] ) ) : ?><p class="se-label"><?php echo esc_html( $a['eyebrow'] ); ?></p><?php endif; ?>
		<h1><?php echo se_text( $a['heading'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
		<ul class="se-ticks">
			<?php foreach ( (array) $a['bullets'] as $b ) : ?>
				<li><?php echo esc_html( $b['text'] ?? '' ); ?></li>
			<?php endforeach; ?>
		</ul>
		<div class="se-cta">
			<a class="se-btn" href="<?php echo esc_url( $a['ctaUrl'] ); ?>"><?php echo esc_html( $a['ctaLabel'] ); ?></a>
			<a class="se-phone-link" href="<?php echo esc_url( $a['phoneUrl'] ); ?>"><?php echo esc_html( $a['phoneNote'] ); ?></a>
		</div>
	</div>
</section>
