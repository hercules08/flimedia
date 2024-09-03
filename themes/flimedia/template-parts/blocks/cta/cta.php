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

// Load values and assign defaults.
$block_settings = get_field_object( 'block_bg' );
	$bg_value = $block_settings['value'];
$cta_title = get_field( 'cta_title' );
$cta_text = get_field( 'cta_text' );

?>

<!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

<div class="block-wrapper">
		
		<div class="block-container">
			<div class="cta-block ">

				<?php if( $cta_title ): ?>
					<p><?php echo $cta_title; ?></p>
				<?php endif; ?>

					<p><?php echo $cta_text; ?></p>

					<?php
					// Check rows exists.
					if( have_rows('cta_repeater') ):
					?>

					<div class="cta-block-btn-wrapper">

						<?php
						// Loop through rows.
						while( have_rows('cta_repeater') ) : the_row();

							$cta_btn = get_sub_field( 'cta_btn' );
							$cta_bg = get_field( 'cta_bg' );
							$cta_spacing = get_field( 'cta_spacing' );
							?>

								<div class="cta-block-btn-container row">
									<div class="cta-block-btn columns small-6">
										<?php 
										if( $cta_btn ): 
											$link_url = $cta_btn['url'];
											$link_title = $cta_btn['title'];
											$link_target = $cta_btn['target'] ? $cta_btn['target'] : '_self';
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

	<!-- <?php 
	// if( $block_settings ): ?>
		<style type="text/css">
			#block_settings {
				background-color: #<?php // echo esc_attr( $block_settings['block_bg'] ); ?>;
			}
		</style>
	<?php // endif; ?> -->

</div>
