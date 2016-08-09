<?php
/**
 * Woo4agm Hooks Configuration
 *
 * Configuration for the Woocommerce Hooks are compiled in this file
 *
 * IMPORTANT NOTES:
 * @note To overwrite the current hooks made by woocommerce, we must remove the hook first
 * @note Any config for a thumbnail must be created in the agm-woocommerce-config.php file
 * @note Any functions called by the hook must be made in the agm-woocommerce-template.php or agm-woocommerce-functions.php file
 *
 */

/**
 * SEO Fixes for images
 *
 * Add titles for actions to draw the images
 * Block starts here
 *
 * @see agm_woocommerce_subcategory_thumbnail()
 * @see agm_woocommerce_template_loop_product_thumbnail()
 */

// Subcategory Thumbnails
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
add_action( 'woocommerce_before_subcategory_title', 'agm_woocommerce_subcategory_thumbnail', 10 );

/**
 * Placeholder image src
 *
 * @see S_NO_IMAGE in ../functions.php
 */
add_filter( 'woocommerce_placeholder_img_src', create_function('$t', 'return "'.S_NO_IMAGE.'";') );
add_filter( 'woocommerce_placeholder_img', 'agm_woocommerce_placeholder_img', 1, 1 );

/*******************************************************************************
 * General Hooks
 *******************************************************************************
 *
 * Override the breadcrumbs to accept arguments in before main content
 * Condition if breadcrumbs is shown or not
 *
 * @see agm-woocommerce-config.php for WOOCOMMERCE_DISPLAY_BREADCRUMBS
 */
add_filter('woocommerce_breadcrumb_defaults', 'agm_breadcrumbs_defaults');
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
$a_haystack = array('ALL','SINGLE_ONLY','NO_PARENT');
if( in_array( WOOCOMMERCE_DISPLAY_BREADCRUMBS, $a_haystack ) ) {
	// Add action for Single Products
	add_action( 'woocommerce_before_single_product', 'woocommerce_breadcrumb', 8, 1 );
}
$a_haystack = array('ALL','ALL_LOOP_ONLY','NO_PARENT_LOOP_ONLY','NO_PARENT');
if( in_array( WOOCOMMERCE_DISPLAY_BREADCRUMBS, $a_haystack ) ) {
	// Add action for Archive Lists (Loop)
	add_action( 'woocommerce_archive_description', 'woocommerce_breadcrumb', 5, 1);
	// Exclusive for parent loop
	add_action( 'woocommerce_archive_description', 'agm_breadcrumb_parent_cat_check', 3 );
}

// transfer the message container inside the agm custom wrapper start
remove_action('woocommerce_before_shop_loop','wc_print_notices', 10);
remove_action('woocommerce_before_single_product','wc_print_notices', 10);

/**
 * Override the home url the breadcrumbs
 *
 * @see agm-woocommerce-config.php for WOOCOMMERCE_BREADCRUMB_MAIN_SHOP
 */
add_filter( 'woocommerce_breadcrumb_home_url', create_function( '$t', 'return "'. WOOCOMMERCE_BREADCRUMB_MAIN_SHOP .'";') );

/**
 * Override the sidebar to accept arguments in before main content
 * Added the condition if sidebar is shown or not
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
add_action( 'woocommerce_sidebar', 'agm_woocommerce_get_sidebar', 10 );

/**
 * Override the default posts per page that is the "blogs per page" in the Reading Options
 *
 * @see agm-woocommerce-config.php for WOOCOMMERCE_POSTS_PER_PAGE
 */
add_filter( 'loop_shop_per_page', create_function( '$t', 'return '. WOOCOMMERCE_POSTS_PER_PAGE .';' ));

/*******************************************************************************
 * Catalogs Hooks
 *******************************************************************************
 *
 * Remove the rating in products list, not used by any theme
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/**
 * Custom Image fix for Parent Categories
 *
 * @see agm-woocommerce-config.php for WOOCOMMERCE_PARENT_CATEGORY_IMAGE_SIZE
 */
$a_img_size = unserialize(WOOCOMMERCE_PARENT_CATEGORY_IMAGE_SIZE);
add_filter( 'woocommerce_get_image_size_shop_parent_catalog', create_function( '$t', 'return array( "width" => '. $a_img_size['width'] .', "height" => '. $a_img_size['height'] .', "crop" => '. $a_img_size['crop'] .');' ));
if( agm_is_parent_cat() ) {
	add_filter('single_product_small_thumbnail_size', create_function( '$t', 'return "shop_parent_catalog";' ));
}


/**
 * Overide pricing on Product Listing to display product current, sale, and save price on product listing
 *
 * @see agm-woocommerce-template.php for agm_product_listing_price()
 */
add_filter( 'woocommerce_get_price_html', 'agm_product_listing_price', 10, 2 );
add_filter( 'woocommerce_variation_sale_price_html', 'agm_product_listing_price', 10, 2 );
add_filter( 'woocommerce_variation_price_html', 'agm_product_listing_price', 10, 2 );

/*******************************************************************************
 * Single Product Hooks
 *******************************************************************************
 *
 * Product Summary Box
 *
 * @see agm_woocommerce_template_single_description()
 */
add_action( 'woocommerce_single_product_summary', 'agm_woocommerce_template_single_description', 45 );

/**
 * Transfter the Product Title outside the entry-summary wrapper
 *
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action('woocommerce_before_single_product','woocommerce_template_single_title',1,0);


//return the number of items per column on product
add_filter('loop_shop_columns', 'loop_columns', 10);
// cart update
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );

//add action give it the name of our function to run
add_action( 'woocommerce_after_shop_loop_item_title', 'wcs_stock_text_shop_page', 25 );
//show print stars
add_action('woocommerce_after_shop_loop_item', 'my_print_stars' );


// repalce billing state
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' , 1);

//add_action( 'woocommerce_after_shop_loop_item_title', 'my_stock', 15);

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

//for auto remove cart item once cancel order is made
add_action( 'woocommerce_cancelled_order', 'woocommerce_clear_cart_url' );

add_filter( 'woocommerce_cross_sells_columns', 'custom_cross_sells_columns' );
?>
