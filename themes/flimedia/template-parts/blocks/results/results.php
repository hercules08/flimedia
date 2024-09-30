<?php
/**
 * Results Block template.
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
$class_name = 'results';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Fetch block settings
$block_settings = get_block_settings_styles(); 

// Load block values.
$results_layout_selector = get_field('results_layout_selector');
$results_title = get_field('results_title');
$results_large_stat = get_field('results_large_stat');
$results_large_stat_label = get_field('results_large_stat_label');
$results_small_stats = get_field('results_small_stats_repeater');
$results_image = get_field('results_img');
$results_image_caption = get_field('results_img_caption');
$results_testimonial_quote             = ! empty( get_field( 'results_testimonial_quote' ) ) ? get_field( 'results_testimonial_quote' ) : 'Your quote here...';
$results_testimonial_author            = get_field( 'results_testimonial_author' );
$results_testimonial_association       = get_field( 'results_testimonial_association' );
?>


<!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

<div class="<?php echo esc_attr($class_name . '-block'); ?> <?php echo esc_attr($block_settings['classes']); ?>">
    <div class="<?php echo esc_attr($class_name . '-block-wrapper'); ?>" style="<?php echo esc_attr($block_settings['styles']); ?>">

		<?php if( $results_title ): ?>
			<p class="results-title uppercase"><?php echo $results_title; ?></p>
		<?php endif; ?>

        <div class="<?php echo esc_attr($class_name . '-container'); ?> row">
            
            <!-- Large Stat Column -->
            <div class="columns small-12 large-6">
				<?php if ($results_layout_selector !== 'image_text'): ?>
					
					<div class="results-large-stat round">
						<h2><?php echo esc_html($results_large_stat); ?></h2>
                        <p><?php echo esc_html($results_large_stat_label); ?></p>
					</div>

				<?php else: ?> 

					<div class="results-large-image">
						<img src="<?php echo esc_url($results_image['url']); ?>" alt="<?php echo esc_attr($results_image['alt']); ?>">
						<?php if ($results_image_caption): ?>
							<p class="results-image-caption">Photo by: <?php echo esc_html($results_image_caption); ?></p>
						<?php endif; ?>
					</div>
					
				<?php endif; ?>
            </div>

            <!-- Small Stats and Testimonial Column -->
            <div class="columns small-12 large-6">
                <div class="row small-up-1 medium-up-2 grid-margin-x">
                    <!-- Small Stats -->
                    <?php if ($results_small_stats): ?>
                        <?php foreach ($results_small_stats as $stat): ?>
                            <div class="results-small-stats columns">
                                <div class="results-small-stat round">
                                    <h3><?php echo esc_html($stat['results_number']); ?></h3>
                                    <p><?php echo esc_html($stat['results_label']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
						<div class="results-large-stat round">
							<h2><?php echo esc_html($results_large_stat); ?></h2>
							<p><?php echo esc_html($results_large_stat_label); ?></p>
						</div>
                    <?php endif; ?>
                </div>

                <!-- Testimonial -->
                <div class="results-testimonial round" style="margin-top: 1rem;">
                    <blockquote>
                        <p>"<?php echo esc_html($results_testimonial_quote); ?>"</p>
                    </blockquote>
					<?php if ($results_testimonial_author): ?>
                    	<p class="results-testimonial-author"><?php echo esc_html($results_testimonial_author); ?></p>
					<?php endif; ?>
					<?php if ($results_testimonial_association): ?>
                    	<p><?php echo esc_html($results_testimonial_association); ?></p>
					<?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>
