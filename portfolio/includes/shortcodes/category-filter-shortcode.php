<?php

    if (! function_exists('category_filter_shortcode')) {
        function category_filter_shortcode() {
            
            ob_start();
    
            
?>
        <div class="category-container" id="ajax-category-search">
                <ul class="portfolio-category">
                    <li>
                        <a href="<?php home_url(); ?>" class="cat-list_item" data-slug="">
                            All
                        </a>
                    </li>
                    <?php
                        $tax_args = array(
                            'exclude' => array(1),
                            'option_all' => 'All'
                        );
                    $taxonomies = get_terms($tax_args);
                    foreach($taxonomies as $taxonomy) : 
                ?>
                <li>
                    <a href="#!" class="cat-list_item" data-slug="<?php echo $taxonomy->slug; ?>">
                        <?php echo($taxonomy->name); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul> 
        </div>

        <div class="portfolio-container">
            <?php
                $args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => 99,
                );
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
                    <p class="portfolio-description"><?php the_field('portfolio_description'); ?></p>
                            </div>
                    <?php
                endwhile;

            endif;
            wp_reset_postdata();
            ?>
            </div>
        

        <?php
            $obj_clean_search = ob_get_clean();
            return $obj_clean_search;
        }
    }
    
    