<?php
/**
 * CTA with Icon Button Block template.
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
	// Note for this block: cwib = cta with icon button

$class_name = 'cwib';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Fetch block settings
$block_settings = get_block_settings_styles(); 

?>


<!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

<div class="<?php echo esc_attr( $class_name . '-block' ); ?> <?php echo esc_attr( $block_settings['classes'] ); ?>">
	<div class="block-wrapper">
				
		<?php if( have_rows('cwib_repeater') ): ?>

			<?php // Count the number of CTAs
            $cta_count = count(get_field('cwib_repeater'));
            ?>

			<div class="block-container row">

				<?php while( have_rows('cwib_repeater') ) : the_row();

					$cwib_title = get_sub_field( 'cwib_title' );
					$cwib_text = get_sub_field( 'cwib_text' );
					$cwib_btn = get_sub_field( 'cwib_btn' );
					$block_bg = get_sub_field( 'block_bg' );

					// Fetch the background color choice
					$cwib_cta_bg = get_sub_field('cwib_cta_bg'); 

					// Set the background style if color is set
					$background_style = $cwib_cta_bg ? 'background-color: #' . esc_attr($cwib_cta_bg) . ';' : '';
					
					// Set text color to white if the background is black
					$text_color = strtolower($cwib_cta_bg) === '001011' ? 'color: #ffffff;' : '';

					// Set spacing class; defaults to 'spacing-md' if not set
					$spacing_class = $cwib_spacing ? 'spacing-' . esc_attr($cwib_spacing) : 'spacing-md';
					
                    // Determine column size based on the number of CTAs
                    $column_class = ($cta_count === 1) ? 'small-12' : 'large-6';
				
					?>

						<div class="cwib-block-btn-container columns <?php echo esc_attr($column_class); ?>">
							<div class="cwib-block-btn round" style="<?php echo $background_style . $text_color; ?>">
								
								<?php if( $cwib_title ): ?>
									<p class="cwib-title uppercase"><?php echo $cwib_title; ?></p>
								<?php endif; ?>

								<p class="cwib-text"><?php echo $cwib_text; ?></p>

								<?php 
								if( $cwib_btn ): 
									$link_url = $cwib_btn['url'];
									$link_title = $cwib_btn['title'];
									$link_target = $cwib_btn['target'] ? $cwib_btn['target'] : '_self';
									?>
										<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								<?php endif; ?>
								
							</div>
						</div>
				
				<?php endwhile; ?>

			<div>

		<?php endif; ?>		

	</div>
</div>
