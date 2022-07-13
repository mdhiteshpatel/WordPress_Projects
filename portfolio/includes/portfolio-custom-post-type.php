<?php

    // Register portfolio custom post type

    if (! function_exists('portfolio_post_type')) {
        function portfolio_post_type() {
            $labels = array(
                'name' => esc_html__('Portfolio', 'mdportfolio'),
                'singular_name' => esc_html__('Portfolio', 'mdportfolio'),
                'menu_name' => esc_html__('Portfolio', 'mdportfolio'),
                'all_items' => esc_html__('All Portfolios', 'mdportfolio'),
                'view_item' => esc_html__('View Portfolio', 'mdportfolio'),
                'add_new_item' => esc_html__('Add New Portfolio', 'mdportfolio'),
                'add_new' => esc_html__('Add New', 'mdportfolio'),
                'edit_item' => esc_html__('Edit Portfolio', 'mdportfolio'),
                'update_item' => esc_html__('Update Portfolio', 'mdportfolio'),
                'search_items' => esc_html__('Search Portfolio', 'mdportfolio'),
                'not_found' => esc_html__('Portfolio Not Found', 'mdportfolio'),
                'not_found_in_trash' => esc_html__('Not Found in Trash', 'mdportfolio')
            );
            $arguments = array(
                'label' => esc_html__('Portfolio', 'mdportfolio'),
                'description' => esc_html__('Portfolio', 'mdportfolio'),
                'labels' => $labels,
                'supports' => array('title', 'thumbnail', 'custom-fields'),
                'public' => true,
                'hierarchical' => false,
                'menu_icon' => 'dashicons-portfolio',
                'show_ui' => true,
                'has_archive' => true,
                'show_in_rest' => true,
                'show_in_nav_menus' => true,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'rewrite' => array('slug' => 'portfolio')
            );
            register_post_type('portfolio', $arguments);
        }
    }

    // Register Category custom taxonomy

    if (! function_exists('portfolio_category_taxonomy')) {
        function portfolio_category_taxonomy() {
            $labels = array(
                'name' => esc_html__('Category'),
                'singular_name' => esc_html__('Category'),
                'search_items' => esc_html__('Search Category'),
                'popular_items' => esc_html__('Popular Categories'),
                'all_items' => esc_html__('All Categories'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => esc_html__('Edit Category'), 
                'update_item' => esc_html__('Update Category'),
                'add_new_item' => esc_html__('Add New Category'),
                'new_item_name' => esc_html__('New Category Name'),
                'separate_items_with_commas' => esc_html__('Separate categories with commas'),
                'add_or_remove_items' => esc_html__('Add or remove category'),
                'choose_from_most_used' => esc_html__( 'Choose from the most used categories'),
                'menu_name' => esc_html__('Category'),
            ); 
            register_taxonomy('category','portfolio',array(
                'hierarchical' => false,
                'labels' => $labels,
                'show_ui' => true,
                'show_in_rest' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'category'),
            ));
        }
    }