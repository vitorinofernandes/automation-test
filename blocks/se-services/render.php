<?php
/**
 * SE Services carousel.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a     = $attributes;
$items = (array) $a['items'];
$total = count( $items );
?>
<section class="alignfull se-section se-services" id="<?php echo esc_attr( $a['anchor'] ); ?>" data-se-carousel>
	<div class="se-inner">
		<div class="se-head">
			<div>
				<h2><?php echo se_text( $a['heading'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				<p class="se-intro"><?php echo esc_html( $a['intro'] ); ?></p>
			</div>
			<a class="se-btn se-btn--outline" href="<?php echo esc_url( $a['buttonUrl'] ); ?>"><?php echo esc_html( $a['buttonLabel'] ); ?></a>
		</div>
		<div class="se-carousel__track">
			<?php foreach ( $items as $i => $it ) : ?>
				<article class="se-card">
					<div class="se-card__top">
						<span class="se-label"><?php echo esc_html( ( $i + 1 ) . ' of ' . $total ); ?></span>
						<?php if ( ! empty( $it['badge'] ) ) : ?>
							<span class="se-badge"><?php echo esc_html( $it['badge'] ); ?></span>
						<?php endif; ?>
					</div>
					<h3><?php echo esc_html( $it['title'] ?? '' ); ?></h3>
					<p><?php echo esc_html( $it['text'] ?? '' ); ?></p>
					<div class="se-card__art"><?php echo se_media_img( $it['image'] ?? '', $it['title'] ?? '', 'se-card__img' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<p class="se-card__price"><?php echo esc_html( $it['price'] ?? '' ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="se-carousel__nav">
			<button type="button" data-dir="-1" aria-label="<?php esc_attr_e( 'Previous', 'stavanger-elektro' ); ?>">&larr;</button>
			<button type="button" data-dir="1" aria-label="<?php esc_attr_e( 'Next', 'stavanger-elektro' ); ?>">&rarr;</button>
		</div>
	</div>
</section>
