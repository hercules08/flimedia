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

// Load values and assign defaults.
$block_settings = get_field_object( 'block_bg' );
	$bg_value = $block_settings['value'];

	// Note for this block: cwib = cta with icon button

?>

<!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

<div class="block-wrapper">
	<div class="block-container">

		<div class="cwib-block">
			
			<?php
			// Check rows exists.
			if( have_rows('cwib_repeater') ):
			?>

			<div class="cwib-wrapper">

				<?php
				// Loop through rows.
				while( have_rows('cwib_repeater') ) : the_row();

					$cwib_title = get_sub_field( 'cwib_title' );
					$cwib_text = get_sub_field( 'cwib_text' );
					$cwib_btn = get_sub_field( 'cwib_btn' );
					$block_bg = get_sub_field( 'block_bg' );
					$block_spacing = get_sub_field( 'block_spacing' );
					?>

						<div class="cwib-block-btn-container row">
							<div class="cwib-block-btn columns small-6">
								
								<?php if( $cwib_title ): ?>
									<p><?php echo $cwib_title; ?></p>
								<?php endif; ?>

								<p><?php echo $cwib_text; ?></p>

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
				
				<?php
				// End loop.
				endwhile;
					?>

			<div>

			<?php
			endif;
			?>		

		</div>
	</div>

</div>
