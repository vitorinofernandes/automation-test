<?php
/**
 * SE Recent work.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a = $attributes;
?>
<section class="alignfull se-section se-work" id="<?php echo esc_attr( $a['anchor'] ); ?>">
	<div class="se-inner">
		<div class="se-head">
			<h2><?php echo se_text( $a['heading'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<a class="se-link" href="<?php echo esc_url( $a['linkUrl'] ); ?>"><?php echo esc_html( $a['linkLabel'] ); ?> &rarr;</a>
		</div>
		<div class="se-work__grid">
			<?php foreach ( (array) $a['items'] as $it ) : ?>
				<?php $tag = ! empty( $it['url'] ) ? 'a' : 'div'; ?>
				<<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput ?> class="se-project"<?php echo ! empty( $it['url'] ) ? ' href="' . esc_url( $it['url'] ) . '"' : ''; ?>>
					<?php echo se_media_img( $it['projectImage'] ?? '', $it['title'] ?? '', 'se-project__img' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<span class="se-label"><?php echo esc_html( $it['tag'] ?? '' ); ?></span>
					<h3><?php echo esc_html( $it['title'] ?? '' ); ?></h3>
				</<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
			<?php endforeach; ?>
		</div>
	</div>
</section>
