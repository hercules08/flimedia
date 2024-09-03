<?php
/**
 * Event Detail Map Block template.
 *
 * @param array $block The block settings and attributes.
 */

$anchor = !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '" ' : '';
$class_name = 'event-detail-map' . (!empty($block['className']) ? ' ' . $block['className'] : '');

$event_date = get_field('event_date', $post_id);
$event_time = get_field('event_time', $post_id);
$event_location = get_field('event_location', $post_id);
$encoded_address = urlencode($event_location);
$iframe_src = "https://www.google.com/maps/embed/v1/place?key=AIzaSyBAM2o7PiQqwk15LC1XRH2e_KJ-jUa7KYk&zoom=14&maptype=roadmap&q=$encoded_address";
$event_description = get_field('event_description', $post_id);
$external_link = get_field('external_link', $post_id);
$external_link_button_text = get_field('external_link_button_text', $post_id);
?>

<div <?php echo esc_attr($anchor); ?> class="<?php echo esc_attr($class_name); ?>">
    <div class="kb-row-layout-wrap kb-row-layout alignnone kt-row-has-bg no-column-padding wp-block-kadence-rowlayout">
        <div class="kt-row-column-wrap kt-has-2-columns kt-row-layout-left-golden kt-tab-layout-row kt-mobile-layout-row kt-row-valign-top kt-inner-column-height-full kb-theme-content-width">
            <div class="wp-block-kadence-column kadence-column">
                <div class="kt-inside-inner-col">
                    <h6 class="wp-block-heading has-palette-color-6-color has-text-color">
                        <?php echo $event_date; ?>
                    </h6>
                    <h4 class="wp-block-heading has-text-color" style="color:#4e4e4e;margin-bottom:0px"><?php the_title(); ?></h4>
                    <p class="has-text-color" style="color:#4e4e4e;margin-top:0px;margin-bottom:24px;font-size:18px;line-height:1.7"><?php echo $event_time; ?></p>
                    <?php if ($event_location): ?>
                        <h6 class="wp-block-heading has-text-color" style="color:#4e4e4e;margin-bottom:5px">LOCATION</h6>
                        <p class="has-text-color" style="color:#4e4e4e;margin-top:0px;margin-bottom:0px"><?php echo $event_location; ?></p>
                    <?php endif; ?>
                    <?php if ($external_link): ?>
                        <div class="wp-block-kadence-advancedbtn kb-btns">
                            <a class="kb-button kt-button button kt-btn-size-standard kt-btn-width-type-auto kb-btn-global-fill kt-btn-has-text-true kt-btn-has-svg-false wp-block-kadence-singlebtn" href="<?php echo esc_url($external_link); ?>" target="_blank" rel="noreferrer noopener">
                                <span class="kt-btn-inner-text">
                                    <?php echo $external_link_button_text ?: 'Learn More'; ?>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="wp-block-kadence-column kadence-column">
                <div class="kt-inside-inner-col">
                    <div class="kb-google-maps-container wp-block-kadence-googlemaps">
                        <iframe width="100%" height="100%" style="border:0" loading="lazy" 
                            src="<?php echo esc_url($iframe_src); ?>" 
                            title="Google map of <?php echo esc_html($event_location); ?>">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
