<?php
/**
 * WooCommerce compatibility
 *
 * @package doodle
 */

// Declare woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Unhook woocommerce wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Hook doodle wrappers
add_action('woocommerce_before_main_content', 'doodle_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'doodle_wrapper_end', 10);
function doodle_wrapper_start() {
  $shop_sidebar = get_theme_mod('doodle_wc_sidebar', 'left');
  switch ($shop_sidebar) {
    case 'right':
      $container_class = "col-md-9 col-lg-8";
      break;
    case 'none':
      $container_class = "col-md-12";
      break;
    default:
      $container_class = "col-md-9 col-md-push-3 col-lg-8 col-lg-push-4";
      break;
  }
  echo '<div class="'. $container_class .'"><div id="primary" class="content-area"><main id="main" class="site-main" role="main">';
}
function doodle_wrapper_end() {
  echo '</main></div></div>';
}

// Remove breadcrumbs & sidebar
add_action( 'init', 'doodle_remove_wc_breadcrumbs_and_sidebar' );
function doodle_remove_wc_breadcrumbs_and_sidebar() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    $shop_sidebar = get_theme_mod('doodle_wc_sidebar', 'left');
    if ($shop_sidebar == "none") {
      remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}

// Change number of products per page
add_filter( 'loop_shop_per_page', 'doodle_wc_products_per_page', 20 );
function doodle_wc_products_per_page($cols) {
  return get_theme_mod('doodle_wc_products_per_page', 9);
}

// Change number of products per row
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return get_theme_mod('doodle_wc_products_per_row', 3);
	}
}

// Columns body class
add_filter('body_class', 'doodle_wc_columns_body_class');
function doodle_wc_columns_body_class($classes){
   if(is_woocommerce()){
     $classes[] = 'columns-'.get_theme_mod('doodle_wc_products_per_row', 3);
   }
   return $classes;
}

// Change number of related products on product page
add_filter( 'woocommerce_output_related_products_args', 'doodle_related_products_args' );
function doodle_related_products_args( $args ) {
	$args['posts_per_page'] = get_theme_mod('doodle_wc_products_per_row', 3); // 3 related products
	$args['columns'] = get_theme_mod('doodle_wc_products_per_row', 3); // arranged in 3 columns
	return $args;
}

// Change number of upsells on product page
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
  function woocommerce_output_upsells() {
      $number = get_theme_mod('doodle_wc_products_per_row', 3);
      woocommerce_upsell_display( $number,$number ); // Display 3 products in rows of 3
  }
}

// Register Shortcake UI for Woocommerce shortcodes
if ( function_exists( 'shortcode_ui_register_for_shortcode' ) ) {

        /**
         * Register a UI for the RECENT PRODUCTS shortcode.
         */
        shortcode_ui_register_for_shortcode(
            'recent_products',
            array(

                // Display label. String. Required.
                'label' => __('Recent Products', 'doodle'),

                // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
                'listItemImage' => 'dashicons-products',

                // Available shortcode attributes and default values. Required. Array.
                // Attribute model expects 'attr', 'type' and 'label'
                // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
                'attrs' => array(
                    array(
                        'label' => __('Number of items to show', 'doodle'),
                        'attr'  => 'per_page',
                        'type'  => 'number',
                        'meta' => array(
                          'placeholder' => '12',
                        ),
                    ),
                    array(
                        'label' => __('Number of columns', 'doodle'),
                        'attr'  => 'columns',
                        'type'  => 'number',
                        'meta' => array(
                          'placeholder' => '4',
                        ),
                    ),
                    array(
                        'label' => __('Order by', 'doodle'),
                        'attr' => 'orderby',
                        'type' => 'select',
                        'options' => array(
                          'date' => __('Date', 'doodle'),
                          'title' => __('Title', 'doodle'),
                          'menu_order' => __('Menu order', 'doodle'),
                          'rand' => __('Random', 'doodle'),
                          'id' => __('ID', 'doodle'),
                        )
                    ),
                    array(
                        'label' => __('Order', 'doodle'),
                        'attr' => 'order',
                        'type' => 'select',
                        'options' => array(
                          'desc' => __('Descending order', 'doodle'),
                          'asc' => __('Ascending order', 'doodle'),
                        )
                    ),
                ),
            )
        );

        /**
         * Register a UI for the FEATURED PRODUCTS shortcode.
         */
        shortcode_ui_register_for_shortcode(
            'featured_products',
            array(

                // Display label. String. Required.
                'label' => __('Featured Products', 'doodle'),

                // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
                'listItemImage' => 'dashicons-products',

                // Available shortcode attributes and default values. Required. Array.
                // Attribute model expects 'attr', 'type' and 'label'
                // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
                'attrs' => array(
                    array(
                        'label' => __('Number of items to show', 'doodle'),
                        'attr'  => 'per_page',
                        'type'  => 'number',
                        'meta' => array(
                          'placeholder' => '12',
                        ),
                    ),
                    array(
                        'label' => __('Number of columns', 'doodle'),
                        'attr'  => 'columns',
                        'type'  => 'number',
                        'meta' => array(
                          'placeholder' => '4',
                        ),
                    ),
                    array(
                        'label' => __('Order by', 'doodle'),
                        'attr' => 'orderby',
                        'type' => 'select',
                        'options' => array(
                          'date' => __('Date', 'doodle'),
                          'title' => __('Title', 'doodle'),
                          'menu_order' => __('Menu order', 'doodle'),
                          'rand' => __('Random', 'doodle'),
                          'id' => __('ID', 'doodle'),
                        )
                    ),
                    array(
                        'label' => __('Order', 'doodle'),
                        'attr' => 'order',
                        'type' => 'select',
                        'options' => array(
                          'desc' => __('Descending order', 'doodle'),
                          'asc' => __('Ascending order', 'doodle'),
                        )
                    ),
                ),
            )
        );

}