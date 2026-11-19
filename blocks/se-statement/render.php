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
if ( '' === $pill1 ) {
	$pill1 = '<span class="se-statement__pill"><span class="se-ph"></span></span>';
}
$pill2 = '<span class="se-statement__pill"><span class="se-ph"></span></span>';
if ( ! empty( $a['inlineImage2'] ) ) {
	$pill2 = '<span class="se-statement__pill">' . se_media_img( $a['inlineImage2'], '', 'se-statement__pill-img' ) . '</span>';
}

// Optional highlight: the first words (the text in "highlight") stay dark, the rest fades to grey.
$statement = trim( (string) $a['statement'] );
$highlight = trim( (string) ( $a['highlight'] ?? '' ) );
$hl_words  = $highlight && 0 === strpos( $statement, $highlight ) ? count( preg_split( '/\s+/', $highlight ) ) : 0;

$words = preg_split( '/\s+/', $statement );
$out   = '';
$done2 = false;
$open  = false;
foreach ( $words as $i => $w ) {
	if ( $hl_words && $i === $hl_words ) {
		$out .= '</span><span class="se-statement__off">';
	}
	if ( $hl_words && 0 === $i ) {
		$out .= '<span class="se-statement__on">';
		$open = true;
	}
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
if ( $open ) {
	$out .= '</span>';
}
// Fallback: pills whose spot was not found go at the end.
if ( $pill1 ) {
	$out .= ' ' . $pill1;
}
if ( $pill2 && ! $done2 ) {
	$out .= ' ' . $pill2;
}
?>
<section class="alignfull se-section se-statement">
	<div class="se-inner">
		<p class="se-statement__text"><?php echo $out; // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
	</div>
</section>
