<?php
/**
 * Woo Functions and Definitions
 *
 * Compatible with WooCommerce 
 *
 * Essential functions and WP settings are defined in this file.
 *
 * INSTALLATION:
 * Include the block of code below to your functions.php:

//Add the agm Woocommerce Functions if plugin is activated
if(class_exists('Woocommerce')) {
	if(TEMPLATE_DIR.'woocommerce/agm-woocommerce-functions.php') {
		require_once('woocommerce/agm-woocommerce-functions.php');
	}
}

 */

/**
 * Base View Files:
 * @see global/wrapper-start.php		= Shop content wrapper start
 * @see globa/wrapper-end.php			= Shop content wrapper end
 *
 * @see loop/add-to-cart.php			= Add to cart, Read More, Select Options button control in product listing
 * @see loop/pagination.php			= Pagination for products listing only
 * @see loop/sale-flash.php			= Sale overlay on products listing
 *
 * @see single-product/description.php	= Product description display
 * @see single-product/meta.php		= Product other details display. Default: SKU
 * @see single-product/sale-flash.php	= Sale overlay on single product featured image
 *
 * @see archive-product.php			= Page Template for Catalogs and Products Listing
 * @see content-product.php			= Product display used in loop
 * @see content-product_cat.php		= Catalog display used in loop
 * @see content-product_parent_cat.php	= Parent Catalog display used in loop (default: /shop/) page
 * @see content-single-product.php		= Page content for Single Products
 * @see single-product.php			= Page Template for Single Products
 *
 * Config Files:
 * @see agm-woocommerce-config.php	= contains the main configuration for the Woo4agm theme
 * @see agm-woocommerce-hooks.php	= contains the custom hooks for Woo4agm
 * @see agm-woocommerce-template.php	= contains the template calling/structuring for Woo4agm
 *
 */

/**
 * Include the Config files for the Woo4agm template
 */
require_once('agm-woocommerce-config.php');
require_once('agm-woocommerce-template.php');
require_once('agm-woocommerce-hooks.php');

/**
 * Add theme support for woocommerce
 */
add_theme_support('woocommerce');

/**
 * Add image size for the parent category
 *
 * @see agm-woocommerce-config.php for WOOCOMMERCE_PARENT_CATEGORY_IMAGE_SIZE
 */
$a_img_size = unserialize(WOOCOMMERCE_PARENT_CATEGORY_IMAGE_SIZE);
add_image_size( 'shop_parent_catalog', $a_img_size['width'], $a_img_size['height'], $a_img_size['crop'] );

/**
 * Settings for using default woocommerce template
 *
 * @see agm-woocommerce-config.php for WOOCOMMERCE_USE_DEFAULT_CSS
 */
if(!WOOCOMMERCE_USE_DEFAULT_CSS)
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

?>