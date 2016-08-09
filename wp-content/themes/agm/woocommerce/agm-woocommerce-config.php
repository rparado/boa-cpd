<?php
/**
 * Woo4agm Configs and Declaration of Defines
 *
 * DEFINES and other declarations will be made here
 * one option is to add a new admin menu, but at the cost of database space
 * this option will serve faster and simplier at the current dev level
 *
 */

/*******************************************************************************
 * Global Variables
 *******************************************************************************
 * Define global variables that we will use throught the theme
 *
 * Check the define if there's a value first before setting a value
 */
if ( !defined('TEMPLATE_DIR') ) {
	define('TEMPLATE_DIR', get_template_directory());
}
if ( !defined('SITE_URL') ) {
	define('SITE_URL', get_bloginfo('url'));
}

/*******************************************************************************
 * General Theme Settings
 *******************************************************************************
 *
 * Breadcrumbs visibility control
 *
 * @String - to display the breadcrumbs on what page (default: all)
 * @option NONE 				- Disable breadcrumbs
 * @option SINGLE_ONLY 			- Show the breadcrumbs in Single Product Pages only
 * @option ALL_LOOP_ONLY 		- Show the breadcrumbs in the parent catalog, catalog/products list pages only
 * @option NO_PARENT_LOOP_ONLY 	- Show the breadcrumbs in the catalog/products list pages only
 * @option NO_PARENT 			- Show the breadcrumbs in all the shop pages except for the parent catalog page
 * @option ALL 				- Display breadcrumbs on all shop pages
 */
define('WOOCOMMERCE_DISPLAY_BREADCRUMBS', 'NO_PARENT');

/**
 * Settings for the breadcrumbs
 */
define('WOOCOMMERCE_BREADCRUMBS_SETTINGS', serialize(array(
		'delimiter'   => '<span class="breadcrumb-delimeter glyphicon glyphicon-chevron-right"></span>', //
		'wrap_before' => '<div class="woocommerce-breadcrumb" itemprop="breadcrumb">',
		'wrap_after'  => '</div>',
		'before'      => '',
		'after'       => '',
		'home'        => _x( 'Products', 'breadcrumb', 'woocommerce' ),
		'show_shop_base_page' => true
	)));

/**
 * Set the home URL of the breadcrumb
 */
define('WOOCOMMERCE_BREADCRUMB_MAIN_SHOP', SITE_URL);

/**
 * Enabled or disable sidebar in shop pages
 *
 * @String - to display the sidebar on what page (default: ALL)
 * @option NONE 				- Disable sidebar
 * @option SINGLE_ONLY 			- Show the sidebar in Single Product Pages only
 * @option ALL_LOOP_ONLY 		- Show the sidebar in the catalog/products list pages only
 * @option NO_PARENT_LOOP_ONLY 	- Show the sidebar in the catalog/products list pages only
 * @option NO_PARENT 			- Show the sidebar in all the shop pages except for the parent catalog page
 * @option ALL 				- Display sidebar on all shop pages
 */
define('WOOCOMMERCE_DISPLAY_SIDEBAR', 'NO_PARENT_LOOP_ONLY');

/**
 * Enabled or disable pagination
 *
 * @Boolean - to display the pagination on each page or not (default: TRUE)
 */
define('WOOCOMMERCE_DISPLAY_PAGINATION', FALSE);

/**
 * Disabling WooCommerce styles
 *
 * @Boolean - to include the default woocommerce CSS or not (default: TRUE)
 *
 * NOTE: Only applies to Products, the catalogs use get_categories() which unforunately doesn't have the pagination option
 */
define('WOOCOMMERCE_USE_DEFAULT_CSS', TRUE);

/**
 * Set the posts per page instead of the default the blogs per page
 *
 * @Integer
 */
define('WOOCOMMERCE_POSTS_PER_PAGE', 1);

/**
 * Set the classes to be inserted on the Nth <li>
 *
 * @String - list of classes to be added
 */
define('WOOCOMMERCE_COLUMNS_LAST_CLASSES', 'last');

/**
 * Set the classes to be inserted on the first <li> of the row
 *
 * @String - list of classes to be added
 */
define('WOOCOMMERCE_COLUMNS_FIRST_CLASSES', 'first');


/*******************************************************************************
 * Catalogs and Sub Catalogs Settings
 *******************************************************************************
 *
 * Set the number of columns for the parent catalogs columns
 *
 * @Integer - Number of columns to add the class "last" on the Nth <li>
 */
define('WOOCOMMERCE_PARENT_CATALOGS_COLUMNS', 3);

/**
 * Set the number of columns for the sub catalogs columns
 *
 * @Integer - Number of columns to add the class "last" on the Nth <li>
 */
define('WOOCOMMERCE_SUB_CATALOGS_COLUMNS', 3);

/**
 * Set if listings will display empty catalogs
 *
 * @Boolean - (default: FALSE)
 */
define('WOOCOMMERCE_DISPLAY_EMPTY_CATALOGS', FALSE);

/**
 * Set the image size for the Parent Catalogs
 *
 * @Array
 *		@element1 - width
 *		@element2 - height
 *		@element3 - crop
 */
define('WOOCOMMERCE_PARENT_CATEGORY_IMAGE_SIZE', serialize(array(
	'width'	=> 223,
	'height'	=> 223,
	'crop'	=> true
)));


/*******************************************************************************
 * Products Settings
 *******************************************************************************
 *
 * Set the number of columns for the products columns
 *
 * @Integer - Number of columns to add the class "last" on the Nth <li>
 */
define('WOOCOMMERCE_PRODUCTS_COLUMNS',3);

/**
 * Set the number of columns for the product thumbnails columns
 *
 * @Integer - Number of columns to add the class "last" on the Nth <li>
 */
define('WOOCOMMERCE_PRODUCT_THUMBNAILS_COLUMNS', 3);

/**
 * Enable Add to Cart on Product Listing
 *
 * @Boolean - (default: TRUE)
 */
define('WOOCOMMERCE_PRODUCTS_ADD_ON_LISTING', TRUE);

/**
 * Override the text on Read More Text on Products Listing Only
 *
 * @String
 */
define('WOOCOMMERCE_READ_MORE_TEXT', 'More Details');

/**
 * Control if you want to show/hide the product tabs in the single products page
 *
 * @Boolean - (default: FALSE)
 */
define('WOOCOMMERCE_SHOW_SINGLE_PRODUCTS_TABS', true);

?>
