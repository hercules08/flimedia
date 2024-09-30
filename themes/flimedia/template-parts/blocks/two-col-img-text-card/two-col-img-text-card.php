<?php
/**
 * Two Column Image and Text Card Block template.
 *
 * @param array $block The block settings and attributes.
 */


/* 
-----------------------------------------------------------------------------------------------

View Key Concepts: https://www.advancedcustomfields.com/resources/acf-blocks-key-concepts/
View Block.json Metadata: https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/

-----------------------------------------------------------------------------------------------
*/


// Create class attribute allowing for custom "className".
	// Note for this block: tcitc = two column image and text card
$class_name = 'tcitc';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Fetch block settings
$block_settings = get_block_settings_styles(); 

// Load block values.
$tcitc_title = get_field('tcitc_title');
$tcitc_image = get_field('tcitc_img');
$tcitc_card_title = get_field('tcitc_card_title');
$tcitc_card_subtitle = get_field('tcitc_card_subtitle');
?>


<!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

<div class="<?php echo esc_attr($class_name . '-block'); ?> <?php echo esc_attr($block_settings['classes']); ?>">
    <div class="<?php echo esc_attr($class_name . '-block-wrapper'); ?>">

		<?php if( $tcitc_title ): ?>
			<p class="tcitc-title uppercase"><?php echo $tcitc_title; ?></p>
		<?php endif; ?>

        <div class="<?php echo esc_attr($class_name . '-container'); ?> row">
            
            <!-- Image Column -->
            <div class="columns small-12 large-6">
                <img src="<?php echo esc_url($tcitc_image['url']); ?>" alt="<?php echo esc_attr($tcitc_image['alt']); ?>" class="tcitc-image round">
            </div>

            <!-- Card Column -->
            <div class="columns small-12 large-6">

                <div class="tcitc-card round" style="<?php echo esc_attr($block_settings['styles']); ?>">

                    <h3 class="tcitc-card-title"><?php echo $tcitc_card_title; ?></h3>

                    <p class="tcitc-card-subtitle uppercase"><?php echo $tcitc_card_subtitle; ?></p>
                        
                    <?php if( have_rows('tcitc_card_subtext_repeater') ): ?>

                        <?php // Count the number of subtext entries
                        $tcitc_card_count = count(get_field('tcitc_card_subtext_repeater'));
                        ?>

                        <div class="tcitc-card-block-container row">
                            <?php while( have_rows('tcitc_card_subtext_repeater') ) : the_row();
                                $tcitc_card_subtext = get_sub_field('tcitc_card_subtext');
                                
                                // Set class based on the count of subtexts
                                $tcitc_card_class = ($tcitc_card_count == 2) ? 'small-12 large-6' : 'small-12';
                                ?>

                                    <div class="tcitc-card-subtext-container columns <?php echo esc_attr($tcitc_card_class); ?>">
                                        <p class="tcitc-subtext"><?php echo $tcitc_card_subtext; ?></p>
                                    </div>
                            
                            <?php endwhile; ?>
                        <div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>
</div>
