<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}


?>
<?php
	$date = new DateTime(get_field('date'));
	//echo $date->format('F'); // should print 07 August
?>
<tr id="<?php echo get_field('thematic_area'); ?>" class="hideShowTr <?php echo $date->format('F'); ?>">
	<td class="date" data-date = "<?php echo get_field('date'); ?>" width="12.5%">
		<?php echo get_field('date'); ?>
	</td>
	<td <?php post_class(); ?> width="30%">
		<?php
			/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
		?>
	</td>
	<td class="thematic-area-data" data-value = <?php echo get_field('thematic_area'); ?>><?php echo get_field('thematic_area'); ?></td>
	<td><?php echo get_field('credit'); ?></td>
	<td class="price-main-wrapper">
		<?php
			/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
	</td>
	<td class="retail-price">
		
		<?php
			/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
		
	</td>
	
	<td>
		<?php 
			$s_package_price = get_field('package_of');
			if($s_package_price) {
				?>&#x20B1;<?php echo get_field('package_of'); ?>
			<?php } ?>
	</td>
	
	<td>
		<?php
			/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</td>
	
</tr>
