<!--  Used for both new and pre-owned vehicle facet listings  -->

<?php if (have_posts() ) : ?>
  <?php while (have_posts() ): the_post(); 
      $inventory_image_urls = get_field('inventory_image_urls');
      $inventory_image_urls_cleaned = str_replace('|', ' ', $inventory_image_urls);
      $inventory_image_urls_cleaned = str_replace(',', '', $inventory_image_urls_cleaned);
      $images = explode(" ", $inventory_image_urls_cleaned);
      $featured_image = is_array($images) ? $images[0] : null;
      // old fields if using photo gallery field instead of vAuto URL string
      // $images = get_field('photo_gallery');
      // $featured_image_url = $featured_image ? $featured_image['url'] : null;
      $featured_image_url = $featured_image ? $featured_image : null;
      $year = get_field('year');
      $make = get_field('make');
      $model = get_field('model');
      $series = get_field('series');
      $body = get_field('body');
      $stock = get_field('stock_number');
      $vin = get_field('vin');
      $msrp = get_field('price_msrp');
      $list_price = get_field('price_list');
      $exterior_color = get_field('exterior_color');
      $interior_description = get_field('interior_description');
      $history_link = get_field('history_report_link');
  ?>
    <div class="inventory-filter-card">
      <a class="image-link display-block" href="<?php the_permalink(); ?>">
          <?php if ($featured_image) { ?>
            <div class="image-wrap">
              <img src="<?php echo $featured_image_url; ?>" alt="<?php the_title(); ?> Image">
            </div>
          <?php } else { ?>
            <div class="image-wrap fallback">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/static-assets/images/RTGT_Logo_Blue.svg" alt="<?php the_title(); ?> Fallback Image">
            </div>
          <?php } ?>
      </a>
      <div class="content">
        <div class="heading">
          <a href="<?php the_permalink(); ?>">
              <h5 class="inventory-title"><?php echo $year; ?> <?php echo $make; ?> <?php echo $model; ?> <?php if ($series !== '') { echo $series; } ?></h5>
          </a>
          <?php if ($body) { ?>
            <p><?php echo $body; ?></p>
          <?php } ?>
        </div>
        <div class="stock">
          <p>Stock: <?php echo $stock; ?></p>
          <p>VIN: <?php echo $vin; ?></p>
        </div>
        <div class="details">
          <div class="top">
            <?php if ($msrp) { ?>
              <div class="price msrp">
                <p>MSRP</p>
                <p>$<?php echo $msrp; ?></p>
              </div>
            <?php } ?>
            <?php if ($list_price) { ?>
              <div class="price">
                <p>Offered At:</p>
                <p><strong>$<?php echo $list_price; ?></strong></p>
              </div>
            <?php } ?>
            <?php if ($exterior_color || $interior_description) { ?> <hr> <div class="colors"> <?php } ?>
            <?php if ($exterior_color) { ?>
              <p class="color">Exterior: <?php echo $exterior_color; ?></p>
            <?php } ?>
            <?php if ($interior_description) { ?>
              <p class="color">Interior: <?php echo $interior_description; ?></p>
            <?php } ?>
            <?php if ($exterior_color || $interior_description) { ?></div><?php } ?>

            <?php /*
                $key_feature_acf_fields = ['android_auto', 'apple_carplay', 'bluetooth', 'backup_camera', 'fog_lights', 'heated_seats', 'interior_accents', 'lane_departure_warning', 'leather_seats', 'lift_kit', 'navigation', 'parking_sensors_assist', 'roof_rack', 'satellite_radio_ready', 'remote_keyless_entry', 'dual_front_side_impact_airbags', 'sunroof_moonroof', 'wifi_hotspot'];
                $key_features_count = 0;

                if (get_field('drivetrain') === 'AWD') {
                  $key_features_count++;
                }

                foreach ($key_feature_acf_fields as $field) {
                  $feature = get_field($field);
                  if (!empty($feature)) {
                    $key_features_count ++;
                  }
                }
            ?>
            <?php if ($key_features_count > 0) : ?>
              <hr>
              <p class="key-features">KEY FEATURES:</p>
              <div class="key-features-wrap">
                <?php if (get_field('drivetrain') === 'AWD') { ?>
                  <div class="key-feature">
                        <div class="feature-icon awd"></div>
                        <p class="tooltip">AWD</p>
                      </div>
                <?php } ?>
                <?php foreach ($key_feature_acf_fields as $field) {
                    $feature = get_field($field);
                    if (!empty($feature[0])) {
                      $feature_class = strtolower($feature[0]);
                      $feature_class = str_replace(' ', '-', $feature_class);
                      $feature_class = preg_replace('/[^A-Za-z0-9\-]/', '', $feature_class);
                      $feature_class = preg_replace('/-+/', '-', $feature_class); 
                      ?>
                      <div class="key-feature">
                        <div class="feature-icon <?php echo $feature_class; ?>"></div>
                        <p class="tooltip"><?php echo $feature[0]; ?></p>
                      </div>
                    <?php } ?>
                <?php } ?>
              </div>
            <?php endif; */ ?>
          </div>
          <div class="buttons">
            <!-- Triggers single modal in footer. Needed for z-indexing of site. -->
            <a href="#" class="custom-modal-trigger inventory-modal-trigger button kb-btn-global-outline display-block" data-modal-id="availabilityModal" 
            data-year="<?php echo $year; ?>"
            data-make="<?php echo $make; ?>"
            data-model="<?php echo $model; ?>"
            data-series="<?php echo $series; ?>"
            data-vin="<?php echo $vin; ?>" 
            data-stock="<?php echo $stock; ?>" 
            data-size="default" aria-label="Register Interest">Register Interest</a>
            <a href="<?php the_permalink(); ?>" class="ct-button btn-primary display-block" data-size="default" aria-label="See Details">See Details</a>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php else : ?>
  <h4><?php _e( 'No inventory found, please add inventory to your selected category.'); ?></h4>
<?php endif; ?>