<?php
/**
 * SE Statement.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="se-section se-statement">
	<div class="se-inner">
		<p class="se-statement__text"><?php echo esc_html( $attributes['statement'] ); ?></p>
	</div>
</section>
