<?php
/**
 * SE Contact — Figma "14 Contact — Van" 230:3561, markup from section_html.
 * The fields are drawn by the block (labels, placeholders and options are block fields);
 * the form is sent to the Contact Form 7 form chosen by ID (or hash), which validates it and sends the mail.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$a     = $attributes;
$theme = get_theme_file_uri();
$uid   = wp_unique_id( 'se-contact-' );

// Contact Form 7 form: by hash (what the shortcode uses) or by post ID.
$form    = null;
$form_id = preg_replace( '/[^a-zA-Z0-9]/', '', (string) $a['formId'] );
if ( '' !== $form_id && function_exists( 'wpcf7_contact_form' ) ) {
	if ( function_exists( 'wpcf7_get_contact_form_by_hash' ) ) {
		$form = wpcf7_get_contact_form_by_hash( $form_id );
	}
	if ( ! $form && ctype_digit( $form_id ) ) {
		$form = wpcf7_contact_form( (int) $form_id );
	}
}

// The form's own fields, in order: a block field without a name takes the next one.
$tags = array();
if ( $form ) {
	foreach ( $form->scan_form_tags() as $tag ) {
		if ( ! empty( $tag->name ) && in_array( $tag->basetype, array( 'text', 'email', 'tel', 'url', 'number', 'date', 'textarea', 'select' ), true ) ) {
			$tags[] = $tag;
		}
	}
}

$fields = is_array( $a['fields'] ) ? $a['fields'] : array();
$hotspot = 'no' !== strtolower( trim( (string) $a['showHotspot'] ) );
?>
<section class="alignfull se-contact" id="<?php echo esc_attr( $a['anchor'] ); ?>" data-figma="230:3561">
	<?php if ( ! empty( $a['backgroundImage'] ) ) : ?>
		<?php echo se_media_img( $a['backgroundImage'], '', 'se-contact__bg' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<?php else : ?>
		<span class="se-ph se-contact__bg" aria-hidden="true"></span>
	<?php endif; ?>
	<div class="se-contact__shade"></div>
	<div class="se-contact__floating-card">
		<form class="se-contact__booking-card se-contact__form" method="post" novalidate
			<?php if ( $form ) : ?>
				action="<?php echo esc_url( rest_url( 'contact-form-7/v1/contact-forms/' . $form->id() . '/feedback' ) ); ?>" data-se-contact
			<?php endif; ?>
		>
			<?php if ( $form ) : ?>
				<input type="hidden" name="_wpcf7" value="<?php echo esc_attr( $form->id() ); ?>">
				<input type="hidden" name="_wpcf7_version" value="<?php echo esc_attr( defined( 'WPCF7_VERSION' ) ? WPCF7_VERSION : '' ); ?>">
				<input type="hidden" name="_wpcf7_locale" value="<?php echo esc_attr( $form->locale() ); ?>">
				<input type="hidden" name="_wpcf7_unit_tag" value="<?php echo esc_attr( 'wpcf7-f' . $form->id() . '-' . $uid ); ?>">
				<input type="hidden" name="_wpcf7_container_post" value="<?php echo esc_attr( (int) get_the_ID() ); ?>">
			<?php endif; ?>
			<div class="se-contact__frame-1984081078">
				<h2 class="se-contact__question"><?php echo se_text( $a['heading'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				<div class="se-contact__fields">
					<?php
					$t = 0;
					foreach ( $fields as $i => $f ) :
						$type  = in_array( $f['type'] ?? '', array( 'text', 'tel', 'email', 'select', 'textarea' ), true ) ? $f['type'] : 'text';
						$tag   = null;
						$name  = trim( (string) ( $f['name'] ?? '' ) );
						if ( '' === $name && isset( $tags[ $t ] ) ) {
							$tag  = $tags[ $t ];
							$name = $tag->name;
							++$t;
						} elseif ( '' !== $name ) {
							foreach ( $tags as $candidate ) {
								if ( $candidate->name === $name ) {
									$tag = $candidate;
								}
							}
						}
						if ( '' === $name ) {
							$name = 'se-field-' . ( $i + 1 );
						}
						$required = 'yes' === strtolower( trim( (string) ( $f['required'] ?? '' ) ) ) || ( $tag && $tag->is_required() );
						$id       = $uid . '-' . ( $i + 1 );
						$ph       = (string) ( $f['placeholder'] ?? '' );
						?>
						<?php if ( 'select' === $type ) : ?>
							<?php
							// Options: the Contact Form 7 field's own values when it has them (so they validate), else the block's.
							$options = ( $tag && ! empty( $tag->values ) ) ? $tag->values : array_values( array_filter( array_map( 'trim', preg_split( '/[,\r\n]+/', (string) ( $f['options'] ?? '' ) ) ) ) );
							?>
							<div class="se-contact__field se-contact__field--select">
								<div class="se-contact__frame-1984081080">
									<label class="se-contact__label" for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $f['label'] ?? '' ); ?></label>
									<select class="se-contact__control" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>"<?php echo $required ? ' required aria-required="true"' : ''; ?>>
										<?php if ( '' !== $ph ) : ?>
											<option value=""><?php echo esc_html( $ph ); ?></option>
										<?php endif; ?>
										<?php foreach ( $options as $option ) : ?>
											<option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<img class="se-contact__icon-chevron-down" src="<?php echo esc_url( $theme ); ?>/assets/icons/icon-chevron-down-52582323.svg" alt="">
							</div>
						<?php else : ?>
							<div class="se-contact__field">
								<label class="se-contact__label" for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $f['label'] ?? '' ); ?></label>
								<?php if ( 'textarea' === $type ) : ?>
									<textarea class="se-contact__control" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" rows="1" placeholder="<?php echo esc_attr( $ph ); ?>"<?php echo $required ? ' required aria-required="true"' : ''; ?>></textarea>
								<?php else : ?>
									<input class="se-contact__control" type="<?php echo esc_attr( $type ); ?>" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" placeholder="<?php echo esc_attr( $ph ); ?>"<?php echo 'email' === $type ? ' autocomplete="email"' : ( 'tel' === $type ? ' autocomplete="tel"' : '' ); ?><?php echo $required ? ' required aria-required="true"' : ''; ?>>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
					<?php if ( ! empty( $a['privacyNote'] ) ) : ?>
						<p class="se-contact__note"><?php echo esc_html( $a['privacyNote'] ); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="se-contact__footer">
				<button type="submit" class="se-contact__button-send"<?php echo $form ? '' : ' disabled'; ?>>
					<span class="se-contact__send-request"><?php echo esc_html( $a['submitLabel'] ); ?></span>
					<img class="se-contact__frame" src="<?php echo esc_url( $theme ); ?>/assets/icons/frame-52292094.svg" alt="">
				</button>
			</div>
			<p class="se-contact__response" role="status" aria-live="polite"></p>
			<?php if ( ! $form && current_user_can( 'edit_posts' ) ) : ?>
				<p class="se-note"><?php esc_html_e( 'Set the Contact Form 7 form ID for this block (and make sure the plugin is active).', 'stavanger-elektro' ); ?></p>
			<?php endif; ?>
		</form>
	</div>
	<?php if ( $hotspot ) : ?>
		<img class="se-contact__hotspot-pulses" src="<?php echo esc_url( $theme ); ?>/assets/icons/hotspot-pulses-2303566.svg" alt="">
	<?php endif; ?>
	<?php if ( ! empty( $a['closing'] ) ) : ?>
		<a class="se-contact__button-call" href="<?php echo esc_url( $a['closingUrl'] ); ?>">
			<img class="se-contact__frame-2" src="<?php echo esc_url( $theme ); ?>/assets/icons/frame-2303720.svg" alt="">
			<span class="se-contact__that-s-us-call-51-54-44-"><?php echo esc_html( $a['closing'] ); ?></span>
		</a>
	<?php endif; ?>
	<?php if ( $hotspot ) : ?>
		<div class="se-contact__callout-line"></div>
	<?php endif; ?>
</section>
