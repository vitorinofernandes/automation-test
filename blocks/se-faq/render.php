<?php
/**
 * SE FAQ.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a     = $attributes;
$items = (array) $a['items'];
?>
<section class="alignfull se-section se-faq" data-se-tabs>
	<div class="se-inner se-faq__grid">
		<div>
			<h2><?php echo se_text( $a['heading'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<div class="se-faq__list" role="tablist">
				<?php foreach ( $items as $i => $it ) : ?>
					<button type="button" role="tab" data-se-tab class="se-faq__q<?php echo 0 === $i ? ' is-active' : ''; ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"><?php echo esc_html( $it['q'] ?? '' ); ?></button>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="se-faq__card">
			<p><strong><?php echo esc_html( $a['name'] ); ?></strong><br /><span class="se-label"><?php echo esc_html( $a['subtitle'] ); ?></span></p>
			<?php foreach ( $items as $i => $it ) : ?>
				<div role="tabpanel" data-se-panel<?php echo 0 === $i ? '' : ' hidden'; ?>>
					<p class="se-faq__q-title"><?php echo esc_html( $it['q'] ?? '' ); ?></p>
					<p><?php echo esc_html( ! empty( $it['a'] ) ? $it['a'] : $a['hint'] ); ?></p>
				</div>
			<?php endforeach; ?>
			<p class="se-faq__call"><span class="se-label"><?php echo esc_html( $a['hint'] ); ?></span><br /><a class="se-phone" href="<?php echo esc_url( $a['phoneUrl'] ); ?>"><?php echo esc_html( $a['phone'] ); ?></a></p>
		</div>
	</div>
</section>
