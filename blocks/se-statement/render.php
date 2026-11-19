<?php
/**
 * SE Statement.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a = $attributes;

// Optional inline "pill" media: pill 1 (video or image) after the 3rd word, pill 2 after "businesses".
$pill1 = '';
if ( ! empty( $a['inlineVideo'] ) ) {
	$pill1 = '<span class="se-statement__pill"><video src="' . esc_url( $a['inlineVideo'] ) . '" poster="' . esc_url( $a['inlineImage'] ?? '' ) . '" autoplay muted loop playsinline aria-hidden="true"></video></span>';
} elseif ( ! empty( $a['inlineImage'] ) ) {
	$pill1 = '<span class="se-statement__pill">' . se_media_img( $a['inlineImage'], '', 'se-statement__pill-img' ) . '</span>';
}
$pill2 = '';
if ( ! empty( $a['inlineImage2'] ) ) {
	$pill2 = '<span class="se-statement__pill">' . se_media_img( $a['inlineImage2'], '', 'se-statement__pill-img' ) . '</span>';
}

$words = preg_split( '/\s+/', trim( (string) $a['statement'] ) );
$out   = '';
$done2 = false;
foreach ( $words as $i => $w ) {
	$out .= ( $i ? ' ' : '' ) . esc_html( $w );
	if ( 2 === $i && $pill1 ) {
		$out  .= ' ' . $pill1;
		$pill1 = '';
	}
	if ( $pill2 && ! $done2 && 0 === stripos( $w, 'businesses' ) ) {
		$out  .= ' ' . $pill2;
		$done2 = true;
	}
}
// Fallback: pills whose spot was not found go at the end.
if ( $pill1 ) {
	$out .= ' ' . $pill1;
}
if ( $pill2 && ! $done2 ) {
	$out .= ' ' . $pill2;
}
?>
<section class="se-section se-statement">
	<div class="se-inner">
		<p class="se-statement__text"><?php echo $out; // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
	</div>
</section>
