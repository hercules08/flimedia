<?php
/**
 * CTA Block template.
 *
 * @param array $block The block settings and attributes.
 */


/* 
-----------------------------------------------------------------------------------------------

View Key Concepts: https://www.advancedcustomfields.com/resources/acf-blocks-key-concepts/
View Block.json Metadata: https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/

-----------------------------------------------------------------------------------------------
*/

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'cta';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Fetch block settings
$block_settings = get_block_settings_styles(); 

// Load values and assign defaults.
$cta_title = get_field( 'cta_title' );
$cta_text = get_field( 'cta_text' );
?>


<?php // Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/<?php echo esc_attr( $class_name ); ?>/block-preview.jpg" alt="Preview of the <?php echo esc_attr( $class_name ); ?> custom block">
    </figure>
<?php } else { ?>


    <!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

    <div class="<?php echo esc_attr( $class_name . '-block' ); ?> <?php echo esc_attr( $block_settings['classes'] ); ?>">
        <div class="block-wrapper">
            <div class="block-container round" style="<?php echo esc_attr( $block_settings['styles'] ); ?>">

                <?php if( $cta_title ): ?>
                    <p class="cta-title uppercase"><?php echo esc_html( $cta_title ); ?></p>
                <?php endif; ?>

                <p class="cta-text"><?php echo esc_html( $cta_text ); ?></p>

                <?php if (have_rows('cta_repeater')): ?>
                    <div class="cta-block-btn-wrapper row">

                        <?php 
                        // Count the number of buttons
                        $button_count = 0;
                        while (have_rows('cta_repeater')) : the_row(); 
                            $button_count++;
                        endwhile;

                        // Reset the loop to output buttons
                        if ($button_count > 0) {
                            reset_rows();
                        }

                        // Output buttons with conditional styles
                        $button_index = 0;
                        while (have_rows('cta_repeater')) : the_row();
                            $button_index++;
                            $cta_btn = get_sub_field('cta_btn');
                            $cta_bg = get_field('cta_bg');
                            $cta_spacing = get_field('cta_spacing');

                            // Determine the style class based on button index
                            $btn_class = ($button_index === 2) ? 'button-outline' : 'button-default'; // Apply inverse style to the second button
                        ?>

                            <div class="cta-block-btn-container columns large-6">
                                <div class="cta-block-btn">
                                    <?php if ($cta_btn): 
                                        $link_url = $cta_btn['url'];
                                        $link_title = $cta_btn['title'];
                                        $link_target = $cta_btn['target'] ? $cta_btn['target'] : '_self';
                                    ?>
                                        <a href="<?php echo esc_url($link_url); ?>" class="<?php echo esc_attr($btn_class); ?>" target="<?php echo esc_attr($link_target); ?>" type="button"><?php echo esc_html($link_title); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>		

            </div>
        </div>
    </div>


<?php } ?>