<?php
/**
* Template Name: Inventory Category Template
*/

get_header(); 

/* This template works as both an automatic taxonomy archive page and as a regular page template. */
if (is_tax( 'inventory_vehicle_types' )) {
    $inventory_term_object = get_queried_object();
    $page_title = $inventory_term_object->name;
} else {
    $inventory_term_object = get_field('vehicle_type_to_show');
    $page_title = get_the_title();
}

$inventory_category_slug = $inventory_term_object->slug;
$exploded_category_slug = explode('-', $inventory_category_slug);
$facet_display_template = implode('_', $exploded_category_slug);

?>


<div class="inventory-filters">
    <div class="ct-container-fluid">
        <div class="entry-content">

            <div class="custom-breadcrumbs-theme">  
                <ul>
                    <li class="breadcrumbs"><a href="https://rtgt-ineosgrenadier.com/" data-type="page" data-id="737" target="_blank" rel="noopener">Home</a></li>
                    <li>Inventory</li>
                    <?php if(is_page()) { ?><li><?php echo the_title(); ?></li><?php } ?>
                    <?php if(is_tax( 'inventory_vehicle_types' )) { ?><li><?php echo $inventory_term_object->name; ?></li><?php } ?>
                </ul>
            </div>

            <?php 
            $args = array(
                'tax_query' => array(             
                    array(
                       'taxonomy' => 'inventory_vehicle_types',
                       'field' => 'slug',
                       'terms' => $inventory_category_slug, 
                   ),
                )
            );
            $tax_query = new WP_Query( $args );
            
            if ($tax_query->have_posts() ) {  ?>
                <div class="filters-results-wrapper">
                    <div id="filters-wrapper" class="filters-wrapper">
                        <div id="filters-header" class="filters-header">
                            <div class="titles">
                                <h3 class="page-title"><?php echo $page_title; ?></h3>
                                <div class="filters-actions">
                                    <h4 class="filters-title">Filters</h4>
                                    <?php echo facetwp_display( 'facet', 'clear_filters' ); ?>
                                </div>
                            </div>
                        </div>
                        <div id="filter-accordions" class="filter-accordions">
                            <div class="filters-selections">
                                <?php echo facetwp_display( 'selections' ); ?>
                                <?php echo facetwp_display( 'facet', 'clear_filters' ); ?>
                            </div>
                            <!-- filter accordions -->
                            <div class="accordion-custom">
                                <div class="accordion-item active">
                                    <div class="accordion-header">
                                        <h6 class="accordion-title">Exterior</h6>
                                        <div class="accordion-icon">
                                            <span class="icon-chevron-down"></span>
                                        </div>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="facet-group">
                                            <p class="group-title">Body</p>
                                            <?php echo facetwp_display( 'facet', 'body' ); ?>
                                        </div>
                                        <div class="facet-group">
                                            <p class="group-title">Exterior Color</p>
                                            <?php  echo facetwp_display( 'facet', 'exterior_color' );  ?>
                                        </div>
                                        <div class="facet-group">
                                            <p class="group-title">Belstaff Edition</p>
                                            <?php echo facetwp_display( 'facet', 'belstaff_edition' ); ?>
                                        </div>
                                        <div class="facet-group">
                                            <p class="group-title">Wheels</p>
                                            <?php echo facetwp_display( 'facet', 'steel_wheels_17' ); ?>
                                            <?php echo facetwp_display( 'facet', 'steel_wheels_18' ); ?>
                                            <?php echo facetwp_display( 'facet', 'alloy_wheels_17' ); ?>
                                            <?php echo facetwp_display( 'facet', 'alloy_wheels_18' ); ?>
                                        </div>
                                        <div class="facet-group">
                                            <p class="group-title">Tires</p>
                                            <?php echo facetwp_display( 'facet', 'bridgestone_dueller_tires' ); ?>
                                            <?php echo facetwp_display( 'facet', 'tires_bf_goodrich_k02' ); ?>
                                        </div>
                                        <div class="facet-group">
                                        <p class="group-title">Additional Features</p>
                                            <?php echo facetwp_display( 'facet', 'access_ladder' ); ?>
                                            <?php echo facetwp_display( 'facet', 'spare_wheel_lockable_storage_box' ); ?>
                                            <?php echo facetwp_display( 'facet', 'exterior_utility_belt' ); ?>
                                            <?php echo facetwp_display( 'facet', 'raised_air_intake' ); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <h6 class="accordion-title">Interior</h6>
                                        <div class="accordion-icon">
                                            <span class="icon-chevron-down"></span>
                                        </div>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="facet-group">
                                            <p class="group-title">Interior Seating</p>
                                            <?php echo facetwp_display( 'facet', 'utility_trim' ); ?>
                                            <?php echo facetwp_display( 'facet', 'leather_trim_black' ); ?>
                                            <?php echo facetwp_display( 'facet', 'leather_trim_grey_black' ); ?>
                                            <?php echo facetwp_display( 'facet', 'heated_seats' ); ?>
                                        </div>
                                        <div class="facet-group">
                                            <p class="group-title">Driver's Pack</p>
                                            <?php echo facetwp_display( 'facet', 'drivers_pack_napa_leather' ); ?>
                                            <?php echo facetwp_display( 'facet', 'drivers_pack_saddle_leather' ); ?>
                                        </div>
                                        <div class="facet-group">
                                            <p class="group-title">Floor</p>
                                            <?php echo facetwp_display( 'facet', 'heavy_duty_utility_flooring_with_drain_valves' ); ?>
                                            <?php echo facetwp_display( 'facet', 'carpet_flooring' ); ?>
                                        </div>
                                        <div class="facet-group">
                                            <p class="group-title">Sound</p>
                                            <?php echo facetwp_display( 'facet', 'standard_audio' ); ?>
                                            <?php echo facetwp_display( 'facet', 'premium_audio' ); ?>
                                        </div>
                                        <div class="facet-group">
                                            <p class="group-title">Additional Features</p>
                                            <?php echo facetwp_display( 'facet', 'safari_windows' ); ?>
                                            <?php echo facetwp_display( 'facet', 'compass_with_altimeter' ); ?>
                                            <?php echo facetwp_display( 'facet', 'interior_utility_rails' ); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <h6 class="accordion-title">Details</h6>
                                        <div class="accordion-icon">
                                            <span class="icon-chevron-down"></span>
                                        </div>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="facet-group">
                                            <p class="group-title">Additional Capabilities</p>
                                            <?php echo facetwp_display( 'facet', 'front_and_rear_diffs' ); ?>
                                            <?php echo facetwp_display( 'facet', '400w_power_take_off' ); ?>
                                            <?php echo facetwp_display( 'facet', 'auxiliary_battery' ); ?>
                                            <?php echo facetwp_display( 'facet', 'high_load_auxiliary_switch_panel' ); ?>
                                            <?php echo facetwp_display( 'facet', 'integrated_winch' ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Accordions -->
                            <button id="applyFilters" class="ct-button btn-primary display-block apply-filters" data-size="default" aria-label="Apply Filters">Apply Fitlers</button> 
                        </div> <!-- End Accordions wrapper .filter-accordions -->
                    </div>
                    <div class="results-wrapper">
                        <!-- results here -->
                        <?php echo facetwp_display( 'template', $facet_display_template); ?>
                    </div>
                    <?php wp_reset_postdata(); ?>
                </div>

            <?php  } else {
                
                if (is_tax( 'inventory_vehicle_types' )) {
                    if ($page_title === 'New Vehicles') {
                        $type = 'New';
                        $other_type = 'Pre-Owned';
                        $other_cat_link = '/vehicle-types/pre-owned-vehicles';
                    } else if ($page_title === 'Pre-Owned Vehicles') {
                        $type = 'Pre-Owned';
                        $other_type = 'New';
                        $other_cat_link = '/vehicle-types/new-vehicles/';
                    } else {
                        $type = '';
                        $other_cat_link = null;
                    }
                    
                } else if (is_page()) {
                    if ($page_title === 'New Vehicles') {
                        $type = 'New';
                        $other_type = 'Pre-Owned';
                        $other_cat_link = '/pre-owned-vehicles';
                    } else if ($page_title === 'Pre-Owned Vehicles') {
                        $type = 'Pre-Owned';
                        $other_type = 'New';
                        $other_cat_link = '/new-vehicles';
                    } else {
                        $type = '';
                        $other_cat_link = null;
                    }
                }
                ?>
                <div style="text-align: center; max-width: 750px; margin-left: auto; margin-right: auto; padding: 30px 0px 60px;">
                    <h2>No <?php echo $type; ?> Vehicles available.</h2>
                    <br>
                    <br>
                    <?php if ($other_cat_link) { ?>
                        <a class="button" href="<?php echo $other_cat_link;?>">Explore <?php echo $other_type; ?> Vehicles</a>
                    <?php } ?>
                </div>
                
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>