<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
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
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>


<?php
	//echo WC()->cart->get_cart_contents_count();
	$cart_items = WC()->cart->get_cart_contents_count();
	global $woocommerce;
	
	if($cart_items < 8) {
		$total_price = $woocommerce->cart->total;
	}
	else {
		$total_price = 3999 * $cart_items;
	}
	switch($total_price) {

		case "8998":
			echo '<a href="http://sjcgroup.net/member/signup/TFShBkcO" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "13497":
			echo '<a href="http://sjcgroup.net/member/signup/usZ8iqO33" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "17996":
			echo '<a href="http://sjcgroup.net/member/signup/mAB82YucR" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "22495":
			echo '<a href="http://sjcgroup.net/member/signup/I8HUGj0Ie" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "26994":
			echo '<a href="http://sjcgroup.net/member/signup/FKsk2wER9" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "31493":
			echo '<a href="http://sjcgroup.net/member/signup/9A6Ngco6c" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "31992":
			echo '<a href="http://sjcgroup.net/member/signup/Wsg4REKbv" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "35991":
			echo '<a href="http://sjcgroup.net/member/signup/x5vN6Jeh1" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
		
		case "39990":
			echo '<a href="http://sjcgroup.net/member/signup/vwMJoXhNE" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
		
		case "43989":
			echo '<a href="http://sjcgroup.net/member/signup/V9l7gvp8" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "47988":
			echo '<a href="http://sjcgroup.net/member/signup/eDwvvHcYy" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "51987":
			echo '<a href="http://sjcgroup.net/member/signup/saIxNIbZ" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "55986":
			echo '<a href="http://sjcgroup.net/member/signup/RBNwDXvr0" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "59985":
			echo '<a href="http://sjcgroup.net/member/signup/FobDfZAV" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "63984":
			echo '<a href="http://sjcgroup.net/member/signup/5i6ZRzova" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "67983":
			echo '<a href="http://sjcgroup.net/member/signup/ceaNtSs1E" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
		
		case "71982":
			echo '<a href="http://sjcgroup.net/member/signup/nt5NHNex8" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "75981":
			echo '<a href="http://sjcgroup.net/member/signup/jxYY2y7fI" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		case "79980":
			echo '<a href="http://sjcgroup.net/member/signup/mm8wNMuZF" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
			break;
			
		default:
			echo '<a href="http://sjcgroup.net/member/signup/7gv7JhzR" class="checkout-button button alt wc-forward" target="_blank">Proceed to Checkout</a>';
	}
?>
