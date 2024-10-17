<?php
/* Template Name: Home Page Template */

get_header(); ?>


<div class="home-container">
    <div class="home-wrapper">



        <!-- BEGIN: Card Slider Block -->
        <div class="card-slider-block">
            <div class="card-slider-wrapper">

                <?php if( have_rows('cs_repeater') ): ?>

                    <div class="combined-slider row">

                        <!-- Fader Slider (Images) -->
                        <div class="fader-slider keen-slider columns medium-12 large-6 round">
                            <?php while( have_rows('cs_repeater') ) : the_row(); 
                                $cs_image = get_sub_field('cs_img');
                                ?>
                                    <div class="fader__slide keen-slider__slide round">
                                        <div class="fader-image" style="background-image: url(<?php echo $cs_image['url']; ?>);"></div>     
                                    </div>
                            <?php endwhile; ?>
                        </div>

                        <!-- Vertical Slider (Text) -->
                        <div class="vertical-slider keen-slider columns medium-12 large-6">

                            <?php while( have_rows('cs_repeater') ) : the_row();
                                $cs_title_small = get_sub_field('cs_title_small');
                                $cs_title_main = get_sub_field('cs_title_main');
                                $cs_content = get_sub_field('cs_content');        
                                $cs_btn = get_sub_field('cs_btn');
                                $cs_image_credit = get_sub_field('cs_img_credit');   
                                $card_count = 0     
                                ?>

                                    <div class="vertical-slider-slides keen-slider__slide">
                                        <div class="card-slider-content-wrapper row round">
                                            <div class="card-slider-content columns small-12 medium-10 small-order-2 medium-order-1">
                                                <div class="card-slider-content-top">
                                                    <p class="card-slider-content-title-small uppercase"><?php echo $cs_title_small; ?></p>
                                                    <h3 class="card-slider-content-title-main"><?php echo $cs_title_main; ?></h3>
                                                </div>
                                                
                                                <div class="card-slider-content-bottom">
                                                    <div class="card-slider-content-text">
                                                        <?php echo $cs_content; ?>
                                                    </div>

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
                                            <div class="card-numbers-container columns small-12 medium-2 small-order-1 medium-order-2">
                                                <div id="card1" class="card-numbers">
                                                    <p>1</p>
                                                </div>
                                                <div id="card2" class="card-numbers">
                                                    <p>2</p>
                                                </div>
                                                <div id="card3" class="card-numbers">
                                                    <p>3</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <?php endwhile; ?>
                        </div>

                    </div><!-- END .combined-slider -->

                <?php endif; ?>

            </div>
        </div>

        <!-- END: Card Slider Block -->


            


    </div>
</div>

<?php get_footer();











        