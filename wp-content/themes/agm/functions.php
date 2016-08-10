<?php
	/*-----------------------------------------------------------------------------------*/
	/* This file will be referenced every time a template/page loads on your Wordpress site
	/* This is the place to define custom fxns and specialty code
	/*-----------------------------------------------------------------------------------*/

// Define the version so we can easily replace it throughout the theme
define( 'AGM', 1.0 );
define('TEMPLATE_URL', get_bloginfo('template_url'));
define('TEMPLATE_DIR', get_template_directory());
define('BLOG_NAME', get_bloginfo('name'));
define('SITE_URL', get_bloginfo('url'));
$agm_custom_post_types = array();

require_once('includes/agm-core-hooks.php');

/*-----------------------------------------------------------------------------------*/
/*  Define Image Dimensions
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_image_size' ) ) {
	add_image_size('banner-image', 1200, 462);
	add_image_size('testimonial', 1476, 659);
}


/*-----------------------------------------------------------------------------------*/
/*  Set the maximum allowed width for any content in the theme
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 960;


/*-----------------------------------------------------------------------------------*/
/* AGM Functions setup
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists('agm_setup') ) {
	function agm_setup() {
		add_editor_style();
		add_theme_support( 'automatic-feed-links' );
		add_theme_support('post-thumbnails');
	}
	register_nav_menus( 
		array(
			'primary'	=>	__( 'Primary Menu', 'agm' ), // Register the Primary menu
			// Copy and paste the line above right here if you want to make another menu, 
			// just change the 'primary' to another name
		)
	);
}
if(class_exists('Woocommerce')) {
	if(TEMPLATE_DIR.'woocommerce/agm-woocommerce-functions.php') {
		require_once('woocommerce/agm-woocommerce-functions.php');
	}
}
/*-----------------------------------------------------------------------------------*/
/* Activate sidebar for Wordpress use
/*-----------------------------------------------------------------------------------*/
function agm_register_sidebars() {
	register_sidebar(array(				// Start a series of sidebars to register
		'id' => 'sidebar', 					// Make an ID
		'name' => 'Sidebar',				// Name it
		'description' => 'Take it on the side...', // Dumb description for the admin side
		'before_widget' => '<div>',	// What to display before each widget
		'after_widget' => '</div>',	// What to display following each widget
		'before_title' => '<h3 class="side-title">',	// What to display before each widget's title
		'after_title' => '</h3>',		// What to display following each widget's title
		'empty_title'=> '',					// What to display in the case of no title defined for a widget
		// Copy and paste the lines above right here if you want to make another sidebar, 
		// just change the values of id and name to another word/name
	));
} 
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'agm_register_sidebars' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function agm_scripts()  { 

	// get the theme directory of css style and link to it in the header
	wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style('font.css', get_stylesheet_directory_uri() . '/fonts/font.css');
	wp_enqueue_style('animate.css', get_stylesheet_directory_uri() . '/css/animate.css');
	wp_enqueue_style('fonticons.css', get_stylesheet_directory_uri() . '/css/font-awesome.css');
	wp_enqueue_style('bootstrap.css', get_stylesheet_directory_uri() . '/css/style.css');
	
	// get the theme directory of js codes and link to it in the footer
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), AGM, true );
	wp_enqueue_script( 'cycle', get_template_directory_uri() . '/js/cycle.min.js', array( 'jquery' ), AGM, true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.js', array( 'jquery' ), AGM, true );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), AGM, true );
	
  
}
add_action( 'wp_enqueue_scripts', 'agm_scripts' ); // Register this fxn and allow Wordpress to call it automatcally in the header


/*-----------------------------------------------------------------------------------*/
/* Custom post types
/*-----------------------------------------------------------------------------------*/

function agm_customPostTypes_and_taxonomies() {
	$a_types = array(
		/**
		 * Declare Custom Post Type ( Use this as the template for declaration )
		 *
		 * @optional slug
		 * @optional supports
		 */
		array(
				'the_type'	=> 'banner-slide',
				'single'	=> 'Banner',
				'plural'	=> 'Banners',
				//'slug'		=> ''
		),
		array(
				'the_type'	=> 'testimonial-items',
				'single'	=> 'Testimonial',
				'plural'	=> 'Testimonials',
				//'slug'		=> ''
		)

	);

	foreach ($a_types as $a_type) {
		// This will merge the defaults and the passed data
		$a_type = wp_parse_args($a_type, array(
			'the_type'	=> '',
			'single'		=> '',
			'plural'		=> '',
			'slug'		=> '',
			'supports'	=> array('title','editor','thumbnail','page-attributes'),
			'has_archive'	=> false
		));

		$a_labels = array(
			'name' 				=> _x($a_type['plural'], 'post type general name'),
			'singular_name' 		=> _x($a_type['single'], 'post type singular name'),
			'add_new' 			=> _x('Add New', $a_type['single']),
			'add_new_item' 		=> __('Add New ' . $a_type['single']),
			'edit_item' 			=> __('Edit ' . $a_type['single']),
			'new_item' 			=> __('New ' . $a_type['single']),
			'view_item' 			=> __('View ' . $a_type['single']),
			'search_items' 		=> __('Search ' . $a_type['plural']),
			'not_found' 			=>  __('No ' . $a_type['plural'] . ' found'),
			'not_found_in_trash'	=> __('No ' . $a_type['plural'] . ' found in Trash')
		);

		$a_rewrite = array(
			'slug'		=> $a_type['slug'],
			'with_front'	=> true,
			'pages'		=> true,
			'feeds'		=> true
		);

		$a_args = array(
			'labels' 		=> $a_labels,
			'public' 		=> true,
			'has_archive' 	=> $a_type['has_archive'],
			'rewrite'      => $a_rewrite,
			'supports' 	=> $a_type['supports']
		);

		register_post_type($a_type['the_type'], $a_args);
		$GLOBALS['agm_custom_post_types'][] = $a_type['the_type'];
	}


	// Start of registration of Custom Taxonomies
	$a_taxonomies = array(
		array(

			// 'the_type'		=> '',
			// 'the_taxonomies'	=> '',
			// 'single'		=> '',
			// 'plural'		=> '',
			// 'root_slug'		=> ''
		)
	);
}
add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_catalog_orderby');
function custom_woocommerce_catalog_orderby( $args ) {
    $args['orderby'] = 'menu_order';
    $args['order'] = 'asc'; 
    return $args;
}
?>