<?php
/**
 * Prevent WP Debug
*/
if (! defined('WP_DEBUG')) {
    die( 'Direct access forbidden.' );
}


/**
 * Init Blocksy Parent
*/
// add_action( 'wp_enqueue_scripts', function () {
// 	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
// });


/**
 * Enqueue Styles & Scripts for the front-end
 */
function theme_load_scripts() {
    // Path for the child theme's main.js and main.css files
    $child_main_js_path = get_stylesheet_directory() . '/build/main.js';
    $child_main_css_path = get_stylesheet_directory() . '/build/main.css';

    // Check if the main.js file exists in the child theme and get its file modification time
    $main_js_version = file_exists($child_main_js_path) ? filemtime($child_main_js_path) : false;

    // Register and enqueue main.js from the child theme
    wp_register_script('theme-main-js', get_stylesheet_directory_uri() . '/build/main.js', [], $main_js_version, true);
    wp_enqueue_script('theme-main-js');

    // Check if the main.css file exists in the child theme and get its file modification time
    $main_css_version = file_exists($child_main_css_path) ? filemtime($child_main_css_path) : false;

    // Enqueue main.css from the child theme
    wp_enqueue_style('theme-main-css', get_stylesheet_directory_uri() . '/build/main.css', [], $main_css_version);
}
add_action('wp_enqueue_scripts', 'theme_load_scripts');

/**
 * Admin Enqueue Styles & Scripts
 */
function theme_enqueue_in_admin() {
    // Path for the child theme's editor.js and editor.css files
    $child_editor_js_path = get_stylesheet_directory() . '/build/editor.js';
    $child_editor_css_path = get_stylesheet_directory() . '/build/editor.css';

    // Check if the editor.js file exists in the child theme and get its file modification time
    $editor_js_version = file_exists($child_editor_js_path) ? filemtime($child_editor_js_path) : false;

    // Register and enqueue editor.js from the child theme
    wp_register_script('theme-editor-js', get_stylesheet_directory_uri() . '/build/editor.js', ['jquery'], $editor_js_version, true);
    wp_enqueue_script('theme-editor-js');

    // Check if the editor.css file exists in the child theme and get its file modification time
    $editor_css_version = file_exists($child_editor_css_path) ? filemtime($child_editor_css_path) : false;

    // Enqueue editor.css from the child theme
    wp_enqueue_style('theme-editor-css', get_stylesheet_directory_uri() . '/build/editor.css', [], $editor_css_version);
}
add_action('admin_enqueue_scripts', 'theme_enqueue_in_admin');


/**
 * Custom Post Types
*/
require get_stylesheet_directory() . '/inc/cpt.php';

/**
 * Blocks
*/
require get_stylesheet_directory() . '/template-parts/blocks.php';


// Add custom block category for FliMedia
function flimedia_block_categories( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'flimedia-category',
                'title' => __( 'Fli Media Blocks', 'flimedia' ),
                'icon'  => 'flimedia-icon', // Replace with your SVG icon if necessary
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'flimedia_block_categories', 10, 2 );


//////Register the custom SVG icon for use in the block editor//////
function flimedia_custom_icon() {
    // Get SVG content
    $icon_path = get_template_directory() . '/static-assets/icons/flimedia-icon.svg';
    $icon_svg = file_get_contents($icon_path);

    // Register the custom icon
    wp_localize_script(
        'flimedia-blocks-editor-script',
        'flimediaIcons',
        array(
            'flimediaIcon' => $icon_svg, // Assign SVG content to icon
        )
    );
}
add_action('enqueue_block_editor_assets', 'flimedia_custom_icon');


/**
 * Block Settings Styles in ACF blocks
 * Handles the retrieval of block background and spacing settings.
 */
function get_block_settings_styles($field_name = 'block_settings') {
    // Fetch the block settings group field
    $block_settings = get_field($field_name);

    // Default values
    $styles = '';
    $classes = '';

    // Get the background color
    if (!empty($block_settings['block_bg'])) {
        $background_color = esc_attr($block_settings['block_bg']);
        $styles .= 'background-color: #' . $background_color . ';';

        // Check for specific background color values to adjust text color
        if (strtolower($background_color) === '001011' || strtolower($background_color) === 'black') {
            $styles .= ' color: #ffffff;'; // Set text color to white if background is `001011` or `black`
        }
    }

    // Get the block spacing and apply a class
    if (!empty($block_settings['block_spacing'])) {
        $classes .= ' spacing-' . esc_attr($block_settings['block_spacing']);
    } else {
        $classes .= ' spacing-md'; // Default spacing if none is set
    }

    // Return the styles and classes in an array for easy use
    return [
        'styles' => $styles,
        'classes' => trim($classes),
    ];
}



function add_custom_preloading() {
    ?>
    <style type="text/css">
        .site-main {
            animation: fadein 0.75s normal forwards;
            animation-delay: 0.35s;
        }
        @keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @-webkit-keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @-moz-keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @-ms-keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @-o-keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
    <?php
}
add_action('wp_head', 'add_custom_preloading');

