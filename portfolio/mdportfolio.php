<?php
/*
    Plugin Name: MD Portfolio
    Version: 1.0
    Description: Portfolio listing plugin
    Author: Hitesh
    Text Domain: mdportfolio
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Includes
include(plugin_dir_path(__FILE__) . 'includes/portfolio-custom-post-type.php');
include(plugin_dir_path(__FILE__) . 'includes/shortcodes/portfolio-shortcode.php');
include(plugin_dir_path(__FILE__) . 'includes/shortcodes/category-filter-shortcode.php');
include(plugin_dir_path(__FILE__) . 'includes/ajax-filter.php');

// Hooks

add_action('init', 'portfolio_post_type');
add_action('init', 'portfolio_category_taxonomy', 0 );
add_action('wp_enqueue_scripts', 'portfolio_js_files');
add_action('wp_ajax_portfolio_ajax_category_filter_search', 'portfolio_ajax_category_filter_search_callback');
add_action('wp_ajax_nopriv_portfolio_ajax_category_filter_search', 'portfolio_ajax_category_filter_search_callback');

// Filters

// Shortcodes
add_shortcode('mdportfolio_shortcode', 'portfolio_listing_shortcode');
add_shortcode('portfolio_category_shortcode', 'category_filter_shortcode');



function portfolio_js_files() {
    wp_enqueue_script('portfolio_ajax_category_filter_search', plugin_dir_url(__FILE__) . 'assets/js/script.js', array(), '1.0', true);
    wp_localize_script('portfolio_ajax_category_filter_search', 'ajax_url', admin_url('admin-ajax.php'));
    wp_enqueue_style('portfolio_main_style', plugin_dir_url(__FILE__) . 'assets/css/main.css');
}