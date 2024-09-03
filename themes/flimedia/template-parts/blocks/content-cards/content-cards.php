<?php
/**
 * Content Cards Block template.
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
$block_settings = get_sub_field_object( 'block_bg' );
	$bg_value = $block_settings['value'];

$content_cards_block_title = get_field('content_cards_block_title');
?>

<!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

<div class="block-wrapper">
							
		<div class="block-container">
			<div class="content-cards-block ">

				<?php if( $content_cards_block_title ): ?>
					<p><?php echo $content_cards_block_title; ?></p>
				<?php endif; ?>

				<?php
				// Check rows exists.
				if( have_rows('content_cards_repeater') ):
				?>				

					<div class="content-cards-block-wrapper">

						<?php
						// Loop through rows.
						while( have_rows('content_cards_repeater') ) : the_row();

							$content_cards_type = get_sub_field_object( 'content_cards_type' );
							$content_cards_type_value = $content_cards_type['value'];
							$content_cards_title = get_sub_field( 'content_cards_title' );
							$content_cards_img = get_sub_field( 'content_cards_img' );
							$content_cards_text = get_sub_field( 'content_cards_text' );
							$content_cards_link = get_sub_field( 'content_cards_link' );
							$content_cards_bg = get_sub_field( 'content_cards_bg' );
							$content_cards_spacing = get_sub_field( 'content_cards_spacing' );
							?>
							
							<?php if( $content_cards_link ): 
									$link_url = $content_cards_link['url'];
									$link_target = $content_cards_link['target'] ? $content_cards_link['target'] : '_self';
									?>
									<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
									<?php endif; ?>

										<div class="content-card-container row">
											<div class="content-card columns small-12 md-4">

												<?php if( $content_cards_type['value'] === 'text' ): ?>
													<p><?php echo esc_html($content_cards_type_value); ?></p>
												<?php else: ?>
													<img src="<?php echo $content_cards_img['sizes']['medium']; ?>" alt="<?php echo $content_cards_img['alt']; ?>">
												<?php endif; ?>

													<p><?php echo $content_cards_text; ?></p>
													
											</div>
										</div>

							<?php if( $content_cards_link ): ?>
									</a>
									<?php endif; ?>
						
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
