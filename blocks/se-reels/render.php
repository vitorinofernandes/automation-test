<?php
/**
 * SE Reels.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a     = $attributes;
$reels = array_values( (array) ( $a['reels'] ?? array() ) );
if ( ! $reels && ! empty( $a['reelVideo'] ) ) {
	// Saved content from before: the single video becomes one tile.
	$reels = array(
		array(
			'reelVideo'   => $a['reelVideo'],
			'posterImage' => $a['posterImage'] ?? '',
			'duration'    => $a['duration'] ?? '',
		),
	);
}
if ( ! $reels ) {
	// Nothing set yet: four placeholder tiles, as in the design.
	$reels = array_fill( 0, 4, array() );
}
?>
<section class="alignfull se-section se-reels">
	<div class="se-inner se-reels__inner">
		<div class="se-reels__text">
			<h2><?php echo esc_html( $a['handle'] ); ?></h2>
			<a class="se-btn se-btn--outline" href="<?php echo esc_url( $a['linkUrl'] ); ?>"><?php echo esc_html( $a['linkLabel'] ); ?></a>
		</div>
		<div class="se-reels__grid">
			<?php foreach ( $reels as $r ) : ?>
				<div class="se-reels__video" data-se-reel>
					<?php if ( ! empty( $r['reelVideo'] ) ) : ?>
						<video src="<?php echo esc_url( $r['reelVideo'] ); ?>" poster="<?php echo esc_url( $r['posterImage'] ?? '' ); ?>" playsinline preload="metadata"></video>
						<button type="button" class="se-reels__play" data-se-reel-play aria-label="<?php esc_attr_e( 'Play video', 'stavanger-elektro' ); ?>">&#9654;</button>
					<?php else : ?>
						<?php echo se_media_img( $r['posterImage'] ?? '', '', 'se-reels__ph' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<?php endif; ?>
					<?php if ( ! empty( $r['duration'] ) ) : ?>
						<span class="se-label se-reels__time"><?php echo esc_html( $r['duration'] ); ?></span>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
