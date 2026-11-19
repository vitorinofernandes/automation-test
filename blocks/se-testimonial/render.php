<?php
/**
 * SE Testimonial.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a = $attributes;
?>
<section class="se-section se-testimonial">
	<div class="se-inner se-testimonial__inner">
		<figure>
			<p class="se-stars" aria-hidden="true"><?php echo esc_html( $a['stars'] ); ?></p>
			<blockquote><?php echo esc_html( $a['quote'] ); ?></blockquote>
			<figcaption><strong><?php echo esc_html( $a['name'] ); ?></strong> <span class="se-label"><?php echo esc_html( $a['place'] ); ?></span></figcaption>
		</figure>
		<a class="se-btn" href="<?php echo esc_url( $a['ctaUrl'] ); ?>"><?php echo esc_html( $a['ctaLabel'] ); ?></a>
	</div>
</section>
