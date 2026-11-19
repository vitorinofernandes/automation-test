<?php
/**
 * SE Marquee.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items = (array) $attributes['items'];
?>
<section class="alignfull se-marquee" aria-label="<?php esc_attr_e( 'Highlights', 'stavanger-elektro' ); ?>">
	<?php foreach ( array( false, true ) as $dup ) : ?>
		<ul class="se-marquee__list"<?php echo $dup ? ' aria-hidden="true"' : ''; ?>>
			<?php foreach ( $items as $it ) : ?>
				<li><?php echo esc_html( $it['text'] ?? '' ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endforeach; ?>
</section>
