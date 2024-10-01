<?php
/**
 * Image Gallery Block template.
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
$class_name = 'img-gallery';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Fetch block settings
$block_settings = get_block_settings_styles(); 

// Load values and assign defaults.
$img_gallery_title = get_field('img_gallery_title');
$img_gallery_main = get_field('img_gallery_main');
?>



<!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

<div class="<?php echo esc_attr( $class_name . '-block' ); ?> <?php echo esc_attr( $block_settings['classes'] ); ?>">
    <div class="block-wrapper">
        <div class="block-container">

            <?php 
            if ($img_gallery_title) : ?>
                <p class="img-gallery-title uppercase"><?php echo $img_gallery_title; ?></p>
            <?php endif ?>

            <div class="img-gallery">

                 <!-- Main featured image display -->
                <div class="img-gallery-main row">
                    <img src="<?php echo esc_url($img_gallery_main['url']); ?>" alt="<?php echo esc_attr($img_gallery_main['alt']); ?>" class="img-gallery-main round">
                </div>

                <!-- Thumbnails below the main image -->
                <?php if (have_rows('img_gallery_repeater')): ?>
                    <div class="img-gallery-thumbnails row small-up-5">
                        <?php while (have_rows('img_gallery_repeater')): the_row();
                            $thumbnail_url = get_sub_field('img_gallery_thumbnail_title');
                            $img_gallery_thumbnails = get_sub_field('img_gallery_thumbnails');
                            ?>

                            <div class="thumbnail column">
                                <img src="<?php echo esc_url($img_gallery_thumbnails['url']); ?>" alt="<?php echo esc_attr($img_gallery_thumbnails['alt']); ?>">
                            </div>

                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>