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
<section class="alignfull se-section se-stats<?php echo ! empty( $a['backgroundImage'] ) ? ' se-stats--has-bg' : ''; ?>">
	<?php if ( ! empty( $a['backgroundImage'] ) ) : ?>
		<?php echo se_media_img( $a['backgroundImage'], '', 'se-stats__bg' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<?php else : ?>
		<span class="se-ph se-stats__bg" aria-hidden="true"></span>
	<?php endif; ?>
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
