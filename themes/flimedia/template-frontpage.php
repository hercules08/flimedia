<?php
/* Template Name: Home Page Template */

get_header(); ?>


<div class="home-container">
    <div class="home-wrapper">



        <!-- BEGIN: Card Slider Block -->
        <div class="card-slider-block">

            <?php if( have_rows('cs_repeater') ): ?>                   
  
                <div class="card-slider-wrapper row">
                    
                    <?php while( have_rows('cs_repeater') ) : the_row();
                        // Set class based on the count of subtexts
                        $cs_card_class = ($cs_card_count == 2) ? 'small-12 large-6' : 'small-12';
                        $cs_card_count = count(get_field('cs_repeater'));

                        $cs_image = get_sub_field('cs_img');
                        $cs_image_credit = get_sub_field('cs_img_credit');
                        $cs_title_small = get_sub_field('cs_title_small');
                        $cs_title_main = get_sub_field('cs_title_main');
                        $cs_content = get_sub_field('cs_content');        
                        $cs_btn = get_sub_field('cs_btn');        
                        ?>

                            <!-- Image Column -->
                            <div class="card-slider-image columns small-12 large-6">
                                <img src="<?php echo esc_url($cs_image['url']); ?>" alt="<?php echo esc_attr($cs_image['alt']); ?>" class="tcitc-image round">
                            </div>

                            <!-- Card Column -->
                            <div class="card-slider-card columns small-12 large-6">
                                <div class="card-slider-content round row">

                                    <div class="card-slider-content-info columns small-12 small-order-2 medium-10 medium-order-1">
                                        <p class="card-slider-content-title-small"><?php echo $cs_title_small; ?></p>
                                        <h3 class="card-slider-content-title-main"><?php echo $cs_title_main; ?></h3>
                                        <div class="card-slider-content-text"><?php echo $cs_content; ?></div>

                                        <?php if ($cs_btn): 
                                            $link_url = $cs_btn['url'];
                                            $link_title = $cs_btn['title'];
                                            $link_target = $cs_btn['target'] ? $cs_btn['target'] : '_self';
                                            ?>
                                            <a href="<?php echo esc_url($link_url); ?>" class="button-linen" target="<?php echo esc_attr($link_target); ?>" type="button"><?php echo esc_html($link_title); ?></a>
                                        <?php endif; ?>  

                                        <?php if( $cs_image_credit ): ?>
                                            <p class="card-slider-image-credit">Photo by: <?php echo esc_html( $cs_image_credit ); ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="card-slider-content-count columns small-12 small-order-1 medium-2 medium-order-2">
                                        1,2,3
                                    </div>
                                                                              
                                </div>
                            </div>

                    <?php endwhile; ?>

                </div>

            <?php endif; ?>

        </div>
        <!-- END: Card Slider Block -->



    </div>
</div>


<?php get_footer();