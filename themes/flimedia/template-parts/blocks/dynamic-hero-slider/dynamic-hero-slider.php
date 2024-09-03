<?php
/**
 * Dynamic Hero Slider Block template.
 *
 * @param array $block The block settings and attributes.
 */

$hero_slides = get_field('hero_slider');
$hero_slides_count = count($hero_slides);
$tabWidth = '100%';
$tabFlex = '0 0 100%';

switch ($hero_slides_count) {
    case 5:
        $tabMaxWidth = '20%';
        $tabFlex = '0 0 20%';
        break; 
    case 4:
        $tabMaxWidth = '25%';
        $tabFlex = '0 0 25%';
        break;
    case 3:
        $tabMaxWidth = '33.33%';
        $tabFlex = '0 0 33.33%';
        break;
    case 2:
        $tabMaxWidth = '50%';
        $tabFlex = '0 0 50%';
        break;
    case 1:
        $tabMaxWidth = '100%';
        $tabFlex = '0 0 100%';
        break;
}

$anchor = !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '" ' : '';
$class_name = 'dynamic-hero-slider' . (!empty($block['className']) ? ' ' . $block['className'] : '');

?>

<div <?php echo esc_attr($anchor); ?> class="<?php echo esc_attr($class_name); ?> alignfull">
    <?php if ($hero_slides): ?>
        <div class="dynamic-slider-container" data-autoplay="false">
            <?php foreach ($hero_slides as $index => $slide): ?>
                <div class="dynamic-slide <?php echo ($index === 0) ? 'active' : ''; ?>" id="<?php echo 'dynamic-slide-' . $index; ?>">
                    <div class="dynamic-slide-background" style="background-image:url('<?php echo esc_url($slide['slide_image']['url']); ?>'); box-shadow: inset 0 0 0 1000px rgba(0, 21, 44,.<?php echo $slide['slide_image_overlay']; ?>);">
                        <?php if ($slide['slide_title_detail'] === 'enabled' && !empty($slide['slide_title_detail_image'])): ?>
                            <img src="<?php echo esc_url($slide['slide_title_detail_image']['url']); ?>" alt="<?php echo esc_attr($slide['slide_title_detail_image']['alt']); ?>" />
                        <?php endif; ?>
                        <h1><?php echo esc_html($slide['slide_title']); ?></h1>
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

        <div class="dynamic-tabs">
            <div class="dynamic-tab-title-container">
                <?php foreach ($hero_slides as $tabTitleIndex => $slide): ?>
                    <div class="dynamic-tab-title <?php echo ($tabTitleIndex === 0) ? 'active' : ''; ?>" id="<?php echo 'dynamic-tab-title-' . $tabTitleIndex; ?>" style="background-image: url('<?php echo esc_url($slide['slide_tab_background_image']['url']); ?>'); max-width: <?php echo $tabMaxWidth; ?>; flex: <?php echo $tabFlex; ?>;">
                        <div>
                            <?php if (!empty($slide['slide_tab_icon'])): ?>
                                <img src="<?php echo esc_url($slide['slide_tab_icon']['url']); ?>" alt="<?php echo esc_attr($slide['slide_tab_icon']['alt']); ?>" />
                            <?php endif; ?>
                            <h5 class="tab-title-<?php echo esc_html($slide['slide_tab_title_width']); ?>"><?php echo esc_html($slide['slide_tab_title']); ?></h5>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="dynamic-tab-container">
                <?php foreach ($hero_slides as $tabIndex => $slide): ?>
                    <div class="dynamic-tab <?php echo ($tabIndex === 0) ? 'active' : ''; ?>" id="<?php echo 'dynamic-tab-' . $tabIndex; ?>">
                        <?php if (!empty($slide['slide_tab_layout'])): ?>
                            <?php foreach ($slide['slide_tab_layout'] as $layout): ?>
                                <?php
                                switch ($layout['acf_fc_layout']) {
                                    case 'content_+_quote':
                                        // Render content_+_quote layout
                                        ?>
                                        <div class="row">
                                            <div class="col-left">
                                                <h3><?php echo esc_html($slide['slide_tab_title']); ?></h3>
                                                <div>
                                                    <?php echo $layout['slide_tab_layout_content']; ?>
                                                    <?php if (!empty($layout['slide_tab_layout_button'])): ?>
                                                        <a href="<?php echo esc_url($layout['slide_tab_layout_button']['url']); ?>" target="<?php echo esc_attr($layout['slide_tab_layout_button']['target']); ?>" class="button"><?php echo esc_html($layout['slide_tab_layout_button']['title']); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-right">
                                                <div class="quote">
                                                    <p>
                                                        <span class="left-quote">&ldquo;</span>
                                                        <?php echo $layout['slide_tab_layout_quote']; ?>
                                                        <span class="right-quote">&rdquo;</span>
                                                    </p>
                                                    <p>
                                                        <span class="quote-author"><?php echo $layout['slide_tab_layout_quote_author']; ?></span>
                                                        <span class="quote-author-title"><?php echo $layout['slide_tab_layout_quote_author_title']; ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;

                                    case 'content_+_image':
                                        // Render content_+_image layout
                                        ?>
                                        <div class="row">
                                            <div class="col-left">
                                                <h3><?php echo esc_html($slide['slide_tab_title']); ?></h3>
                                                <div>
                                                    <?php echo $layout['slide_tab_layout_content']; ?>
                                                    <?php if (!empty($layout['slide_tab_layout_button'])): ?>
                                                        <a href="<?php echo esc_url($layout['slide_tab_layout_button']['url']); ?>" target="<?php echo esc_attr($layout['slide_tab_layout_button']['target']); ?>" class="button"><?php echo esc_html($layout['slide_tab_layout_button']['title']); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-right">
                                                <div class="image">
                                                    <?php 
                                                    $image_id = $layout['slide_tab_layout_image'];
                                                    if ($image_id): 
                                                        echo wp_get_attachment_image($image_id, 'full');
                                                    endif; 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;

                                    case 'content':
                                        // Render content layout
                                        ?>
                                        <h3><?php echo esc_html($slide['slide_tab_title']); ?></h3>
                                        <div class="row">
                                            <div class="col-full">
                                                <div>
                                                    <?php echo $layout['slide_tab_layout_content']; ?>
                                                    <?php if (!empty($layout['slide_tab_layout_content_disclaimer'])): ?>
                                                        <p class="disclaimer">
                                                            <?php echo $layout['slide_tab_layout_content_disclaimer']; ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    <?php if (!empty($layout['slide_tab_layout_button'])): ?>
                                                        <a href="<?php echo esc_url($layout['slide_tab_layout_button']['url']); ?>" target="<?php echo esc_attr($layout['slide_tab_layout_button']['target']); ?>" class="button"><?php echo esc_html($layout['slide_tab_layout_button']['title']); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                }
                                ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            
        </div>
    <?php endif; ?>
</div>
