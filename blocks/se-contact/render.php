<?php
/**
 * SE Contact. The form itself is a Contact Form 7 form chosen by ID.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a = $attributes;
?>
<section class="alignfull se-section se-contact<?php echo ! empty( $a['backgroundImage'] ) ? ' se-contact--has-bg' : ''; ?>" id="<?php echo esc_attr( $a['anchor'] ); ?>">
	<?php if ( ! empty( $a['backgroundImage'] ) ) : ?>
		<?php echo se_media_img( $a['backgroundImage'], '', 'se-contact__bg' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<?php else : ?>
		<span class="se-ph se-contact__bg" aria-hidden="true"></span>
	<?php endif; ?>
	<div class="se-inner se-contact__inner">
		<div class="se-contact__card">
		<h2><?php echo se_text( $a['heading'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
		<div class="se-contact__form">
			<?php
			if ( ! empty( $a['formId'] ) && shortcode_exists( 'contact-form-7' ) ) {
				echo do_shortcode( '[contact-form-7 id="' . esc_attr( preg_replace( '/[^a-zA-Z0-9]/', '', $a['formId'] ) ) . '"]' ); // phpcs:ignore WordPress.Security.EscapeOutput
			} elseif ( current_user_can( 'edit_posts' ) ) {
				echo '<p class="se-note">' . esc_html__( 'Set the Contact Form 7 form ID for this block (and make sure the plugin is active).', 'stavanger-elektro' ) . '</p>';
			}
			?>
		</div>
		<?php if ( ! empty( $a['privacyNote'] ) ) : ?>
			<p class="se-contact__note"><?php echo esc_html( $a['privacyNote'] ); ?></p>
		<?php endif; ?>
		</div>
		<p class="se-contact__closing"><a href="<?php echo esc_url( $a['closingUrl'] ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/></svg><?php echo esc_html( $a['closing'] ); ?></a></p>
	</div>
</section>
