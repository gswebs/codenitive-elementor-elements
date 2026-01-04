<?php
/*
Plugin Name: Elementor Elements by Codenitive
Plugin URI:  https://github.com/gswebs/codenitive-elementor-elements
Description: A collection of Elementor widgets and extensions for enhanced design and functionality.
Version: 1.0.3
Requires at least: 5.6
Tested up to: 6.5
Requires PHP: 7.4
Requires Plugins: elementor
Author: Codenitive
Author URI: https://codenitive.com
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: codenitive-elementor-elements
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check if Elementor is loaded
 */
add_action( 'plugins_loaded', function () {
    if ( ! did_action( 'elementor/loaded' ) ) {
        return;
    }
});

/**
 * Register widgets
 */
add_action( 'elementor/widgets/register', function( $widgets_manager ) {

    $widget_file = plugin_dir_path( __FILE__ ) . 'includes/widgets/marquee.php';

    if ( file_exists( $widget_file ) ) {
        require_once $widget_file;

        if ( class_exists( 'Codenit_Marquee_List_Widget' ) ) {
            $widgets_manager->register( new \Codenit_Marquee_List_Widget() );
        }
    }
    
    $reviews_file = plugin_dir_path( __FILE__ ) . 'includes/widgets/products-reviews.php';

    if ( file_exists( $reviews_file ) ) {
        require_once $reviews_file;

        if ( class_exists( 'CodeNit_All_Reviews_Widget' ) ) {
            $widgets_manager->register( new \CodeNit_All_Reviews_Widget() );
        }
    }

    $show_all_btn = plugin_dir_path( __FILE__ ) . 'includes/widgets/show-all-button.php';

    if ( file_exists( $show_all_btn ) ) {
        require_once $show_all_btn;

        if ( class_exists( 'CodeNit_All_Reviews_Widget' ) ) {
            $widgets_manager->register( new \Codenit_Elementor_ShowAll() );
        }
    }
    
});

/**
 * Register frontend styles
 */
add_action( 'wp_enqueue_scripts', function () {

    $css_path = plugin_dir_path( __FILE__ ) . 'assets/css/marquee.css';
    $css_url  = plugin_dir_url( __FILE__ ) . 'assets/css/marquee.css';

    $prreview_path_css = plugin_dir_path( __FILE__ ) . 'assets/css/products-reviews.css';
    $prreview_url_css  = plugin_dir_url( __FILE__ ) . 'assets/css/products-reviews.css';
    
    $prreview_path_js = plugin_dir_path( __FILE__ ) . 'assets/js/product-reviews.js';
    $prreview_url_js  = plugin_dir_url( __FILE__ ) . 'assets/js/product-reviews.js';

    wp_register_style(
        'codenitive-marquee-style',
        $css_url,
        [],
        file_exists( $css_path ) ? filemtime( $css_path ) : '1.0.2'
    );

    wp_register_style(
        'codenitive-products-reviews-style',
        $prreview_url_css,
        [],
        file_exists( $prreview_path_css ) ? filemtime( $prreview_path_css ) : '1.0.2'
    );
    
    wp_register_script(
		'codenit-product-review-js',
		$prreview_url_js,
		[],
		file_exists( $prreview_path_js ) ? filemtime( $prreview_path_js ) : '1.0.2',
		true
	);
    
});

/**
 * Enqueue styles only when Elementor frontend is active
 */
add_action( 'elementor/frontend/after_enqueue_styles', function () {
    wp_enqueue_style( 'codenitive-marquee-style' );
    wp_enqueue_style( 'codenitive-products-reviews-style' );
    wp_enqueue_script( 'codenit-product-review-js' );
});
/**
 * Load text domain for translations
 */
add_action( 'plugins_loaded', function () {
    load_plugin_textdomain( 'codenitive-elementor-elements', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
});