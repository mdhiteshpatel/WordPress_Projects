<?php

    if ( ! function_exists('portfolio_ajax_category_filter_search_callback') ) {
        function portfolio_ajax_category_filter_search_callback() {
            $tax_query = array();
            if ( ! empty( $_GET['taxonomy'] ) ) {
                $taxonomy = sanitize_text_field($_GET['taxonomy']);
                $tax_query[] = array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $taxonomy
                );
            }
?>
            <div class="portfolio-container">
                <?php
                $args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => 99,
                    );
                if ( ! empty($tax_query) ) {
                    $args['tax_query'] = $tax_query;
                }
                    

                    $search_query = new WP_Query($args);
                        if ($search_query->have_posts()) :
                            while($search_query->have_posts()) :
                                $search_query->the_post();
                ?>
                <div class="portfolio-box">
                    <h1><?php the_field('portfolio_name'); ?></h1>
                        <?php
                            $portfolio_img = get_field('portfolio_image');
                                if ($portfolio_img) :
                                    $url = $portfolio_img['url'];
                                    $alt = $portfolio_img['alt'];
                                    $size = 'small';
                                    $small = $portfolio_img['sizes'][$size];
                                    $width = $portfolio_img['width'];
                                    $height = $portfolio_img['height']; 
                        ?>
                            <img src="<?php echo esc_url($url); ?>" 
                                alt="<?php echo esc_attr($alt); ?>" 
                                width="<?php echo esc_attr($width); ?>" 
                                height="<?php echo esc_attr($height); ?>" />
                        <?php endif; ?>
                        <p class="portfolio-description">
                            <?php the_field('portfolio_description'); ?>
                        </p>
                </div>
                <?php
                    endwhile;
                    endif;

                    wp_reset_postdata();
                ?>
                
            </div>
            <?php
                wp_die();
        }
    }