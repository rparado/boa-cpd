<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); 
$return_to = site_url().'/training/#products-table';

?>
<a href="<?php echo $return_to; ?>" class="button wc-forward pull-right" style="margin-bottom: 15px;">Continue Shopping</a>
<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" class="clearfix" style="clear:both">

<?php do_action( 'woocommerce_before_cart_table' ); ?>
<div class="table-responsive">
	<table class="shop_table shop_table_responsive cart" cellspacing="0" id="cart-table">
		<thead>
			<tr>
				<th>Date</th>
				<th class="product-name">Topic</th>
				<th>Thematic<br /> Area</th>
				<th>Credit</th>
				<th class="product-price">Regular<br />Price</th>
				<th>Retail<br />Price</th>
				<th>Package of <br />(8) Courses</th>
				<th  class="product-remove">Buy Now</th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td data-title="Date"><?php echo get_field('date', $_product->id); ?></td>
						<td class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
							<?php
								echo get_the_title($_product->id);
							?>
						</td>

						<td data-title="Thematic area"><?php echo get_field('thematic_area', $_product->id); ?></td>
						<td data-title="Credit"><?php echo get_field('credit', $_product->id); ?></td>

						<td data-title="Regular price">
							<?php
								$price = wc_price(get_post_meta( $_product->id, '_regular_price', true));
								echo $price;
							?>
						</td>
						<td class="product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>
						<td data-title="Package">
							<?php 
								$s_package_price = get_field('package_of', $_product->id);
								if($s_package_price) {
									?>&#x20B1;<?php echo $s_package_price; ?>
							<?php } ?>
						</td>
						<td class="product-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove delete-order" title="%s" data-product_id="%s" data-product_sku="%s">Cancel</a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
						</td>
					</tr>
					<?php
					}
				}

			do_action( 'woocommerce_cart_contents' );
			?>
			<tr class="hide">
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">

							<label for="coupon_code"><?php _e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />

							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
</div>


<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
