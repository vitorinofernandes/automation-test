<?php
/**
 * SE Reels.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a = $attributes;
?>
<section class="se-section se-reels">
	<div class="se-inner se-reels__inner">
		<div class="se-reels__text">
			<h2><?php echo esc_html( $a['handle'] ); ?></h2>
			<a class="se-btn se-btn--outline" href="<?php echo esc_url( $a['linkUrl'] ); ?>"><?php echo esc_html( $a['linkLabel'] ); ?></a>
		</div>
		<div class="se-reels__video">
			<?php if ( ! empty( $a['reelVideo'] ) ) : ?>
				<video src="<?php echo esc_url( $a['reelVideo'] ); ?>" poster="<?php echo esc_url( $a['posterImage'] ); ?>" controls playsinline preload="metadata"></video>
			<?php else : ?>
				<?php echo se_media_img( $a['posterImage'], '', 'se-reels__ph' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<?php endif; ?>
			<span class="se-label se-reels__time"><?php echo esc_html( $a['duration'] ); ?></span>
		</div>
	</div>
</section>
