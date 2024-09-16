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


// Create class attribute allowing for custom "className".
$class_name = 'content-cards';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Fetch the block settings using the reusable function
$block_settings = get_block_settings_styles(); 

// Load block title
$content_cards_block_title = get_field('content_cards_block_title');
?>


<!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

<div class="<?php echo esc_attr($class_name . '-block'); ?> <?php echo esc_attr($block_settings['classes']); ?>" style="<?php echo esc_attr($block_settings['styles']); ?>">
	<div class="content-cards-block-wrapper">
    
		<?php if ($content_cards_block_title): ?>
			<p class="content-cards-block-title uppercase"><?php echo esc_html($content_cards_block_title); ?></p>
		<?php endif; ?>

		<div class="content-cards-block-container row">

			<?php if (have_rows('content_cards_repeater')): ?>
				<?php while (have_rows('content_cards_repeater')): the_row(); 
					// Fetch repeater fields
					$content_cards_type = get_sub_field('content_cards_type');
					$content_cards_title = get_sub_field('content_cards_title');
					$content_cards_text = get_sub_field('content_cards_text');
					$content_cards_link = get_sub_field('content_cards_link');
					$content_cards_bg = get_sub_field('content_cards_bg'); // Fetch the background color
					$content_cards_image = get_sub_field('content_cards_img'); // Fetch the image field

					// Set the background style if color is set
					$card_background_style = $content_cards_bg ? 'background-color: #' . esc_attr($content_cards_bg) . ';' : '';
				?>

					<div class="content-card round columns small-12 medium-4" style="<?php echo $card_background_style; ?>">
						<?php if ($content_cards_type === 'text'): ?>
							<p class="content-card-title"><?php echo esc_html($content_cards_title); ?></p>
						<?php elseif ($content_cards_type === 'img' && $content_cards_image): ?>
							<div class="content-card-image">
								<img src="<?php echo esc_url($content_cards_image['url']); ?>" alt="<?php echo esc_attr($content_cards_image['alt']); ?>">
							</div>
						<?php endif; ?>

						<p class="content-card-text"><?php echo esc_html($content_cards_text); ?></p>


						<?php if ($content_cards_link): 
							$link_url = $content_cards_link['url'];
							$link_title = $content_cards_link['title'];
							$link_target = $content_cards_link['target'] ? $content_cards_link['target'] : '_self';
						?>
							<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
						<?php endif; ?>
					</div>

				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>