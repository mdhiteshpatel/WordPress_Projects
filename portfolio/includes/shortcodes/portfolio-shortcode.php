<?php

    // Creating shortcode with parameters so that user can define what's queried

    if (! function_exists('portfolio_listing_shortcode')) {
        function portfolio_listing_shortcode($atts) {
            ob_start();

            // define attributes and defaults
            extract(shortcode_atts(array(
                'type' => 'portfolio',
                'order' => 'ASC',
                'posts' => '',
            ), $atts));

            // Get all the category
            $taxonomies = get_terms('category');


            // define query parameters based on attributes
            $options = array(
                'post_type' => $type,
                'order' => $order,
                'posts_per_page' => $posts,
                'post_status' => 'publish'
            );

            $portfolio_list_query = new WP_Query($options);
            // run the loop based on the query
            if ($portfolio_list_query->have_posts()) { 
                
?>
            <div class="container">
                <div class="portfolio-category">
                    <select name="category" id="category" class="portfolio-category">
                        <option value="" selected>Category</option>
                        <?php
                            foreach($taxonomies as $taxonomy) {
                        ?>
                        <option value="<?php echo $taxonomy->slug; ?>">
                                <?php echo($taxonomy->name); ?>
                        </option>
                        <?php    } ?>
                    </select>
                </div>
                <div class="portfolio-box">
                <?php
                    while($portfolio_list_query->have_posts()) :
                        $portfolio_list_query->the_post();
                    ?>
                <div class="portfolio-title">
                        <p><?php the_field('portfolio_name'); ?></p>
                </div>
                <div class="portfolio-img">
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
                </div>
                <div class="portfolio-desc">
                    <p><?php the_field('portfolio_description'); ?></p>
                </div>
                <?php 
                endwhile; ?>
            </div>
            </div>
           <?php 
            }
            $portfolio_var = ob_get_clean();
                return $portfolio_var;
        }
        
    }