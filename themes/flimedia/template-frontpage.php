<?php
/* Template Name: Home Page Template */

get_header(); ?>


<div class="home-container">
    <div class="home-wrapper">



        <!-- BEGIN: Card Slider Block -->
        <div class="card-slider-block">
            <div class="card-slider-wrapper">

                <?php if( have_rows('cs_repeater') ): ?>
                    <div class="row">

                        <!-- Image Column (Fader Slider) -->
                        <div class="card-slider-image columns large-6">
                            <div class="keen-slider fader-slider">
                                <?php while( have_rows('cs_repeater') ) : the_row(); 
                                    $cs_image = get_sub_field('cs_img');
                                ?>
                                    <div class="keen-slider__slide">
                                        <img src="<?php echo esc_url($cs_image['url']); ?>" alt="<?php echo esc_attr($cs_image['alt']); ?>" class="fader-image">
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <!-- Card Column (Vertical Slider) -->
                        <div class="card-slider-content columns large-6 keen-slider vertical-slider">
                            <?php while( have_rows('cs_repeater') ) : the_row();
                                $cs_title_small = get_sub_field('cs_title_small');
                                $cs_title_main = get_sub_field('cs_title_main');
                                $cs_content = get_sub_field('cs_content');        
                                $cs_btn = get_sub_field('cs_btn');
                                $cs_image_credit = get_sub_field('cs_img_credit');        
                            ?>
                                <div class="keen-slider__slide">
                                    <div class="card-slider-content-wrapper round row">
                                        <div class="card-slider-content-info columns small-12">
                                            <p class="card-slider-content-title-small uppercase"><?php echo $cs_title_small; ?></p>
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
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                    </div>
                <?php endif; ?>

            </div>
        </div>

        <!-- END: Card Slider Block -->


            


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/keen-slider@6.8.5/keen-slider.min.js"></script>

<?php get_footer();