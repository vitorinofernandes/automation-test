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
<section class="se-section se-contact<?php echo ! empty( $a['backgroundImage'] ) ? ' se-contact--has-bg' : ''; ?>" id="<?php echo esc_attr( $a['anchor'] ); ?>">
	<?php if ( ! empty( $a['backgroundImage'] ) ) : ?>
		<?php echo se_media_img( $a['backgroundImage'], '', 'se-contact__bg' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<?php endif; ?>
	<div class="se-inner se-contact__inner">
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
		<p class="se-contact__closing"><a href="<?php echo esc_url( $a['closingUrl'] ); ?>"><?php echo esc_html( $a['closing'] ); ?></a></p>
	</div>
</section>
