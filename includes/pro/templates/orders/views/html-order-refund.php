<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * @var object $refund The refund object.
 */
$who_refunded = new WP_User( $refund->post->post_author );
?>
<tr class="refund <?php echo ( ! empty( $class ) ) ? $class : ''; ?>" data-order_refund_id="<?php echo $refund->id; ?>">
	<!-- <td class="check-column"></td> -->

	<td class="thumb"><div><i class="fa fa-money"></i></div></td>

	<td class="name">
		<?php
			echo esc_attr__( 'Refund', 'dokan' ) . ' #' . absint( $refund->id ) . ' - ' . esc_attr( date_i18n( get_option( 'date_format' ) . ', ' . get_option( 'time_format' ), strtotime( $refund->post->post_date ) ) );

			if ( $who_refunded->exists() ) {
				echo ' ' . esc_attr_x( 'by', 'Ex: Refund - $date >by< $username', 'dokan' ) . ' ' . '<abbr class="refund_by" title="' . esc_attr__( 'ID: ', 'dokan' ) . absint( $who_refunded->ID ) . '">' . esc_attr( $who_refunded->display_name ) . '</abbr>' ;
			}
		?>
		<?php if ( $refund->get_refund_reason() ) : ?>
			<p class="description"><?php echo esc_html( $refund->get_refund_reason() ); ?></p>
		<?php endif; ?>
		<input type="hidden" class="order_refund_id" name="order_refund_id[]" value="<?php echo esc_attr( $refund->id ); ?>" />
	</td>

	<?php do_action( 'woocommerce_admin_order_item_values', null, $refund, absint( $refund->id ) ); ?>

	<td class="item_cost" width="1%">&nbsp;</td>
	<td class="quantity" width="1%">&nbsp;</td>

	<td class="line_cost" width="1%">
		<div class="view">
			<?php echo wc_price( '-' . $refund->get_refund_amount() ); ?>
		</div>
	</td>

	<?php if ( ( ! isset( $legacy_order ) || ! $legacy_order ) && wc_tax_enabled() ) : for ( $i = 0;  $i < count( $order_taxes ); $i++ ) : ?>

		<td class="line_tax" width="1%"></td>

	<?php endfor; endif; ?>

	<td class="wc-order-edit-line-item">
		<div class="wc-order-edit-line-item-actions">
			<!-- <a class="delete_refund" href="#">X</a> -->
		</div>
	</td>
</tr>