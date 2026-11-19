<?php
/**
 * SE Pricing (price explorer).
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a     = $attributes;
$items = (array) $a['items'];
?>
<section class="se-section se-pricing" id="<?php echo esc_attr( $a['anchor'] ); ?>" data-se-tabs>
	<div class="se-inner">
		<div class="se-pricing__intro">
			<h2><?php echo se_text( $a['heading'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<p class="se-intro"><?php echo esc_html( $a['intro'] ); ?></p>
		</div>
		<div class="se-pricing__grid">
			<div class="se-pricing__list" role="tablist">
				<?php foreach ( $items as $i => $it ) : ?>
					<button type="button" role="tab" data-se-tab class="se-pricing__tab<?php echo 0 === $i ? ' is-active' : ''; ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>">
						<span><?php echo esc_html( $it['name'] ?? '' ); ?></span>
						<span class="se-label"><?php echo esc_html( $it['price'] ?? '' ); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
			<div class="se-pricing__panels">
				<?php foreach ( $items as $i => $it ) : ?>
					<div class="se-pricing__panel" role="tabpanel" data-se-panel<?php echo 0 === $i ? '' : ' hidden'; ?>>
						<p class="se-label"><?php echo esc_html( strtoupper( $it['name'] ?? '' ) ); ?></p>
						<?php $opts = array_filter( array_map( 'trim', explode( ',', (string) ( $it['options'] ?? '' ) ) ) ); ?>
						<?php if ( $opts ) : ?>
							<div class="se-chips">
								<?php foreach ( $opts as $o ) : ?>
									<span class="se-chip"><?php echo esc_html( $o ); ?></span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $it['packagePrice'] ) ) : ?>
							<p class="se-label"><?php echo esc_html( $a['packageLabel'] ); ?></p>
							<p class="se-pricing__price"><?php echo esc_html( $it['packagePrice'] ); ?> <small><?php echo esc_html( $a['vatNote'] ); ?></small></p>
						<?php else : ?>
							<p class="se-pricing__price"><?php echo esc_html( $it['price'] ?? '' ); ?></p>
						<?php endif; ?>
						<?php $inc = se_lines( $it['included'] ?? '' ); ?>
						<?php if ( $inc ) : ?>
							<ul class="se-ticks">
								<?php foreach ( $inc as $line ) : ?>
									<li><?php echo esc_html( $line ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<a class="se-btn" href="<?php echo esc_url( $a['ctaUrl'] ); ?>"><?php echo esc_html( $a['ctaLabel'] ); ?></a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
