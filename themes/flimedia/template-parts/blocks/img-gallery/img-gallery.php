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
            <div class="block-container">

                <?php 
                if ($img_gallery_title) : ?>
                    <p class="img-gallery-title uppercase"><?php echo $img_gallery_title; ?></p>
                <?php endif ?>

                <div class="img-gallery">

                    <?php if (have_rows('img_gallery_repeater')):
                        $thumbnail_count = count(get_field('img_gallery_repeater')); 
                        ?>

                        <div class="img-gallery-main row">
                            <?php $first = true;
                                while (have_rows('img_gallery_repeater')): the_row();
                                    $img_gallery_main = get_sub_field('img_gallery_thumbnails');
                                    
                                    if ($first): ?>
                                        <img src="<?php echo esc_url($img_gallery_main['url']); ?>" alt="<?php echo esc_attr($img_gallery_main['alt']); ?>" class="round">
                                        <?php $first = false;
                                    endif;
                                    
                                endwhile;
                            ?>
                        </div>

                        <div class="img-gallery-thumbnails row <?php echo 'small-up-' . $thumbnail_count; ?>">
                            <?php while (have_rows('img_gallery_repeater')): the_row();
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

<?php } ?>