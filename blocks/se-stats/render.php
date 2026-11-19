<?php
/**
 * SE Stats.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a = $attributes;
?>
<section class="se-section se-stats">
	<div class="se-inner se-stats__inner">
		<h2><?php echo se_text( $a['heading'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
		<div class="se-stats__grid">
			<?php foreach ( (array) $a['items'] as $it ) : ?>
				<div class="se-stat">
					<span class="se-stat__value"><?php echo esc_html( $it['value'] ?? '' ); ?></span>
					<span class="se-label"><?php echo esc_html( $it['label'] ?? '' ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
