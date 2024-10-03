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
                'icon'  => '<svg id="flimedia" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 219.82 200.48"><g id="flimedia_1"><path d="M42.94,200.41H7.91c-4.36,0-7.89-3.53-7.89-7.89,0-.22,0-.45,0-.67,0-52.28-.05-104.56.02-156.84C.08,4.2,4.24.07,34.73.02,56.57-.01,160.34,0,202.49,0c9.57,0,17.33,7.76,17.33,17.33v29.07c0,7.5-6.07,13.58-13.57,13.58-37.1,0-128.8-.01-143.15,0-2.08,0-3.89,1.3-5.39,3.11-3.98,4.8-.98,12.1,5.21,12.83,15.16,1.78,108.91.68,140.32.7,7.5,0,13.58,6.09,13.58,13.59,0,7.5-6.07,13.58-13.56,13.58-44.68.04-92-.06-137.32-.06-12.37,0-14,5-14.54,16.02-.23,4.61-.72,53.25-.56,72.69.04,4.38-3.51,7.95-7.89,7.95Z"/><path d="M139.98,167.21c4.8-12.3,9.6-24.6,14.42-36.9,1.26-3.21,2.29-6.44,3.92-9.61,2.16-4.22,8.23-6.82,17.95-7.03,12.23-.27,24.51-.11,37.27-.08,2.06,0,3.74.73,3.74,1.62v57.39c0,15.2-12.32,27.52-27.52,27.52h-18.86v-25.51c0-.83-.65-1.52-1.48-1.56h0c-.63-.03-1.22.32-1.49.89-.89,1.86-1.83,3.71-2.55,5.58-2.29,5.9-4.72,11.8-6.53,17.73-.74,2.43-2.78,3.34-8.54,3.22-8.03-.16-16.09-.09-24.8-.06-3.04,0-5.78-1.85-6.88-4.68-3.05-7.82-6.99-17.94-8.35-21.42-.28-.72-1.03-1.13-1.79-.99h0c-.76.14-1.31.81-1.31,1.58v25.25s-47.9,0-47.9,0v-72.98c0-2.27-1.33-13.4,3.4-13.57,6.95-.24,22.27.16,41.65.32,10.05.08,14.34,4.18,15.96,8.39,5.27,13.73,10.71,27.45,16.11,41.17.5,1.27,1.19,2.52,1.79,3.79l1.82-.05Z"/></g></svg>',
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'flimedia_block_categories', 10, 2 );


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

