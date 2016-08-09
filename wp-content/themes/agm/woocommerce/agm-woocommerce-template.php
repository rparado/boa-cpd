<?php
/**
 * Woo4TAGM Template Definition
 *
 * Construction for the custom template structure is compiled in this file
 *
 * IMPORTANT NOTES:
 * @note Actual hooks creation and function call is done in the agm-woocommerce-hooks.php
 * @note Acutal include of the view file is done here
 * @note Other modules that is needed for the view file must be declared in this file
 *
 */

/**
 * Show subcategory thumbnails with SEO fix
 *
 * @access public
 * @param mixed $category
 * @subpackage	Loop
 * @return void
 */
function agm_woocommerce_subcategory_thumbnail( $category ) {
	global $woocommerce;

	$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
	$thumbnail_id  		= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}

	if ( $image )
		echo '<img src="' . $image . '" alt="' . $category->name . '" title="' . $category->name . '" />';
}

/**
 *
 */
function agm_woocommerce_placeholder_img( $html ) {
	return preg_replace('/(width|height)="\d+"\s/', "", str_replace('alt="Placeholder"', 'alt="Placeholder" title="Placeholder"', $html) );
}

if ( ! function_exists( 'agm_woocommerce_get_sidebar' ) ) {

	/**
	 * Cloned get the shop sidebar template, to have the conditional option
	 *
	 * @access public
	 * @return void
	 */
	function agm_woocommerce_get_sidebar() {

		/**
		 * @see agm-woocommerce-config.php for WOOCOMMERCE_DISPLAY_SIDEBAR
		 */
		$a_haystack = array('ALL','SINGLE_ONLY','NO_PARENT');
		$a_haystack_a = array('ALL','ALL_LOOP_ONLY');
		$a_haystack_b = array('NO_PARENT_LOOP_ONLY','NO_PARENT');
		if( is_product() && in_array( WOOCOMMERCE_DISPLAY_SIDEBAR, $a_haystack ) ) {
			wc_get_template( 'global/sidebar.php' );
		}
		elseif( !is_product() && (in_array( WOOCOMMERCE_DISPLAY_SIDEBAR, $a_haystack_a ) || (!agm_is_parent_cat() && in_array( WOOCOMMERCE_DISPLAY_SIDEBAR, $a_haystack_b ))) ) {
			wc_get_template( 'global/sidebar.php' );
		}

		return FALSE;
	}
}

if ( ! function_exists( 'agm_woocommerce_template_single_description' ) ) {

	/**
	 * Output the product description.
	 *
	 * @access public
	 * @subpackage	Product
	 * @return void
	 */
	function agm_woocommerce_template_single_description() {
		woocommerce_get_template( 'single-product/short-description.php' );
	}
}

if ( ! function_exists( 'agm_breadcrumb_parent_cat_check' ) ) {

	/**
	 * Disable the breadcrumbs on parent categories based on the config
	 *
	 * @access public
	 * @see agm-woocommerce-config.php for WOOCOMMERCE_DISPLAY_BREADCRUMBS
	 */
	function agm_breadcrumb_parent_cat_check() {
		if(agm_is_parent_cat() && (WOOCOMMERCE_DISPLAY_BREADCRUMBS != 'ALL' && WOOCOMMERCE_DISPLAY_BREADCRUMBS != 'ALL_LOOP_ONLY') ) {
			remove_action( 'woocommerce_archive_description', 'woocommerce_breadcrumb', 5, 1);
		}
	}

}

if( ! function_exists( 'agm_breadcrumbs_defaults' ) ) {

	/**
	 * This function will override the breadcrumbs defaults
	 *
	 * @access public
	 * @see agm-woocommerce-config.php for WOOCOMMERCE_BREADCRUMBS_SETTINGS
	 */
	function agm_breadcrumbs_defaults() {
		return unserialize(WOOCOMMERCE_BREADCRUMBS_SETTINGS);
	}
}

if ( ! function_exists( 'agm_is_parent_cat' ) ) {

	/**
	 * Checks if current page is parent catalog or not
	 *
	 * @access public
	 *
	 * @return Boolean
	 */
	function agm_is_parent_cat() {
		$term = get_queried_object();
		return empty( $term->term_id );
	}

}

if ( ! function_exists( 'agm_woocommerce_product_subcategories' ) ) {

	/**
	 * Display product sub categories as thumbnails.
	 *
	 * Modified clone of woocommerce_product_subcategories() to have the control to show empty categories
	 *
	 * @access public
	 * @subpackage	Loop
	 * @param array $args
	 * @return bool
	 */
	function agm_woocommerce_product_subcategories( $args = array() ) {
		global $wp_query, $woocommerce;

		$defaults = array(
			'before'  => '',
			'after'  => '',
			'force_display' => false
		);

		$args = wp_parse_args( $args, $defaults );

		extract( $args );

		// Main query only
		if ( ! is_main_query() && ! $force_display ) return;

		// Don't show when filtering, searching or when on page > 1 and ensure we're on a product archive
		if ( is_search() || is_filtered() || is_paged() || ( ! is_product_category() && ! is_shop() ) ) return;

		// Check categories are enabled
		if ( is_shop() && get_option( 'woocommerce_shop_page_display' ) == '' ) return;

		// Find the category + category parent, if applicable
		$term 			= get_queried_object();
		$parent_id 		= empty( $term->term_id ) ? 0 : $term->term_id;

		if ( is_product_category() ) {
			$display_type = get_woocommerce_term_meta( $term->term_id, 'display_type', true );

			switch ( $display_type ) {
				case 'products' :
					return;
				break;
				case '' :
					if ( get_option( 'woocommerce_category_archive_display' ) == '' )
						return;
				break;
			}
		}

		// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( http://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work
		$args = array(
			'child_of'		=> $parent_id,
			'menu_order'	=> 'ASC',
			'hide_empty'	=> !WOOCOMMERCE_DISPLAY_EMPTY_CATALOGS,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'product_cat',
			'pad_counts'	=> 1
		);
		$product_categories = get_categories( apply_filters( 'woocommerce_product_subcategories_args', $args ) );

		$product_category_found = false;

		if ( $product_categories ) {

			foreach ( $product_categories as $category ) {

				if ( $category->parent != $parent_id || ($category->count == 0 && !WOOCOMMERCE_DISPLAY_EMPTY_CATALOGS) )
					continue;

				if ( ! $product_category_found ) {
					// We found a category
					$product_category_found = true;
					echo $before;
				}

				if( $parent_id == 0 && file_exists(TEMPLATE_DIR . '/woocommerce/content-product_parent_cat.php') ) {
					wc_get_template( 'content-product_parent_cat.php', array(
						'category' => $category
					) );
				}
				else
					wc_get_template( 'content-product_cat.php', array(
						'category' => $category
					) );

			}

		}

		// If we are hiding products disable the loop and pagination
		if ( $product_category_found ) {
			if ( is_product_category() ) {
				$display_type = get_woocommerce_term_meta( $term->term_id, 'display_type', true );

				switch ( $display_type ) {
					case 'subcategories' :
						$wp_query->post_count = 0;
						$wp_query->max_num_pages = 0;
					break;
					case '' :
						if ( get_option( 'woocommerce_category_archive_display' ) == 'subcategories' ) {
							$wp_query->post_count = 0;
							$wp_query->max_num_pages = 0;
						}
					break;
				}
			}
			if ( is_shop() && get_option( 'woocommerce_shop_page_display' ) == 'subcategories' ) {
				$wp_query->post_count = 0;
				$wp_query->max_num_pages = 0;
			}

			echo $after;
			return true;
		}

	}
}

if ( ! function_exists( 'agm_product_listing_price' ) ) {

	/**
	 * Overide pricing on Product Listing to display product current, sale, and save price on product listing
	 * @access public
	 * @subpackage	Loop
	 * @param array $args
	 * @return html
	 */
	function agm_product_listing_price($price,$product) {
		$current_price = woocommerce_price(0);
		if ( $product->price > 0 ) {
			$current_price=woocommerce_price($product->get_price());
		} elseif($product->min_bundle_price) { // bundle price
			$current_price=woocommerce_price($product->min_bundle_price);
		}

		if(!empty($product->price)) {
		$our_price = <<<EOF

<div class="current-price"><span class="product-price-label">Our Price: </span><span >{$current_price}</span></div>

EOF;

		if($product->product_type=="variable") {
			if ( $product->price > 0 && $product->is_on_sale() && isset( $product->min_variation_price ) && $product->min_variation_regular_price !== $product->get_price() ) {
				$save_price=woocommerce_price(($product->min_variation_regular_price-$product->get_price()));
				$regular_price=woocommerce_price($product->min_variation_regular_price);
			}

		} elseif($product->product_type=="variation") {
			if ( $product->price == $product->sale_price && $product->sale_price < $product->regular_price ) {
				$save_price=woocommerce_price(($product->regular_price-$product->get_price()));
				$regular_price=woocommerce_price($product->regular_price);
			}
		} elseif($product->product_type=="bundle") {

			if ( $product->per_product_pricing_active && $product->min_bundle_price > 0 &&  $product->is_on_sale() && $product->min_bundle_regular_price !== $product->min_bundle_price) {
				$save_price=woocommerce_price(($product->min_bundle_regular_price-$product->get_price()));
				$regular_price=woocommerce_price($product->min_bundle_regular_price);

			} elseif($product->price > 0 && $product->is_on_sale() && isset( $product->regular_price )) {
				$sale_price=woocommerce_price(($product->regular_price-$product->get_price()));
				$regular_price=woocommerce_price($product->regular_price);
			}

		} elseif($product->product_type=="simple") {
			// simple
			if ( $product->price > 0 && $product->is_on_sale() && isset( $product->regular_price)) {
				$save_price=woocommerce_price(($product->regular_price-$product->get_price()));
				$regular_price=woocommerce_price($product->regular_price);

			}

		}
	}
		if(!empty($save_price) && !empty($regular_price)){
			$our_price.= <<<EOF

<div class="regular-price"><span>{$regular_price}</span></div>
EOF;
		}
		return $our_price;
	}
}
if ( ! function_exists( 'agm_page_content_start' ) ) {

	/**
	 * add agm custom wrapper after breadcrumbs
	 * @access public
	 * @subpackage	global
	 * @return void
	 */
	function agm_page_content_start() {
		wc_get_template( 'global/agm-page-content-start.php' );
	}
}
if ( ! function_exists( 'agm_page_content_end' ) ) {

	/**
	 * closes the agm custom wrapper after breadcrumbs
	 * @access public
	 * @subpackage	global
	 * @return void
	 */
	function agm_page_content_end() {
		wc_get_template( 'global/agm-page-content-end.php' );
	}
}

//cart update
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
	<?php

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}

//single product custom tabs
function woo_rename_tabs( $tabs ) {
	$tabs['description']['title'] = __( 'Product information' );		// Rename the description tab
	$tabs['reviews']['title'] = __( 'Ratings' );				// Rename the reviews tab
	//$tabs['additional_information']['title'] = __( 'Product Data' );	// Rename the additional information tab

	return $tabs;

}

if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 5; // 3 products per row
	}
}

//create our function
function wcs_stock_text_shop_page() {

	//returns an array with 2 items availability and class for CSS
	global $product;
	$availability = $product->get_availability();

	//check if availability in the array = string 'Out of Stock'
	//if so display on page.//if you want to display the 'in stock' messages as well just leave out this, == 'Out of stock'
	if ( $availability['availability'] == 'Out of stock') {
	    echo apply_filters( 'woocommerce_stock_html', '<p class="stock stock-alert ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
	}
}

function my_print_stars(){
    global $wpdb;
    global $post;
    $count = $wpdb->get_var("
    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
    WHERE meta_key = 'rating'
    AND comment_post_ID = $post->ID
    AND comment_approved = '1'
    AND meta_value > 0
");

$rating = $wpdb->get_var("
    SELECT SUM(meta_value) FROM $wpdb->commentmeta
    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
    WHERE meta_key = 'rating'
    AND comment_post_ID = $post->ID
    AND comment_approved = '1'
");

if ( $count > 0 ) {

    $average = number_format($rating / $count, 2);

    echo '<div class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

    echo '<span class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> </span></span>';

    echo '</div>';
    }

}

//chaneg billing-_state label
function custom_override_checkout_fields( $fields ) {
	$fields['billing']['billing_state']['label'] = 'State';
	$fields['shipping']['shipping_state']['label'] = 'State';
	$fields['order']['order_comments']['placeholder'] = 'Notes about your order, e.g. special notes for delivery';
	return $fields;
}

// function my_stock() {
// 	global $product;
// 	if($product->total_stock) {
// 		echo '<div class="stocks-left">';
// 		echo "Items left:".$product->total_stock;
// 		echo '</div>';
// 	}
	
// }
function woocommerce_clear_cart_url() {
  global $woocommerce;
	$woocommerce->cart->empty_cart();
}

function custom_cross_sells_columns( $columns ) {
	return 5;
}
?>
