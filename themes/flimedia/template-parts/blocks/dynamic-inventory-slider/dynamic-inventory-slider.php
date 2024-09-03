<?php
/**
 * Dynamic Inventory Slider Block template.
 *
 * @param array $block The block settings and attributes.
 */
$post_id = get_the_ID();
$inventory_image_urls = get_field('inventory_image_urls', $post_id);


$anchor = !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '" ' : '';
$class_name = 'dynamic-inventory-slider' . (!empty($block['className']) ? ' ' . $block['className'] : '');

?>

<?php if ($inventory_image_urls): 

    $inventory_image_urls_cleaned = str_replace('|', ' ', $inventory_image_urls);
    $inventory_image_urls_cleaned = str_replace(',', '', $inventory_image_urls_cleaned);
    $inventory_slides = explode(" ", $inventory_image_urls_cleaned);
    
?>
    <div <?php echo esc_attr($anchor); ?> class="<?php echo esc_attr($class_name); ?> alignfull">
        <div class="dynamic-slider-container" data-autoplay="false">
            <?php foreach ($inventory_slides as $index => $slide): ?>
                <div class="dynamic-slide <?php echo ($index === 0) ? 'active' : ''; ?>" id="<?php echo 'dynamic-slide-' . $index; ?>">
                    <div class="dynamic-slide-background" style="background-image:url('<?php echo esc_url($slide); ?>');">
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="dynamic-slider-navigation">
                <button class="dynamic-slider-prev" type="button" aria-label="Previous slide" style="display:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40" focusable="false"><path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path></svg>
                </button>
                <button class="dynamic-slider-next" type="button" aria-label="Next slide">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40" focusable="false"><path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path></svg>
                </button>
            </div>
        </div>

        <div class="dynamic-thumbnail-navigation">
            <div class="dynamic-thumbnail-container">
                <?php foreach ($inventory_slides as $thumbnailIndex => $slide): ?>
                    <div class="dynamic-thumbnail <?php echo ($thumbnailIndex === 0) ? 'active' : ''; ?>" id="<?php echo 'dynamic-thumbnail-' . $thumbnailIndex; ?>" style="background-image: url('<?php echo esc_url($slide); ?>');">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
<?php endif; ?>
