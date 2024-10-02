<?php
/**
 * We register our block's with WordPress's handy
 * register_block_type();
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_type/
 */

 
 // Load the SVG icon from the flimedia-icon.svg file
function flimedia_get_svg_icon($icon_name) {
    $icon_path = get_template_directory() . '/static-assets/icons/' . $icon_name . '.svg';
    if (file_exists($icon_path)) {
        return file_get_contents($icon_path);
    }
    return '';
}

function rtgt_register_acf_blocks() {
    if (!function_exists('register_block_type')) {
        return;
    }

    $blocks_dir = __DIR__ . '/blocks';
    $block_folders = scandir($blocks_dir);

    foreach ($block_folders as $folder) {
        if ($folder === '.' || $folder === '..') {
            continue;
        }

        $block_path = $blocks_dir . '/' . $folder;
        if (is_dir($block_path)) {
            register_block_type($block_path, array(
                'icon' => flimedia_get_svg_icon('flimedia-icon'), // Load the custom SVG icon
            ));

            // Dynamically set the handles for editor and view scripts
            $editor_script_handle = $folder . '-handle-js-editor';
            $view_script_handle = $folder . '-handle-js-view';

            // Dynamically generate the paths for the editor and view scripts
            $editor_script_path = get_stylesheet_directory_uri() . '/template-parts/blocks/' . $folder . '/' . $folder . '-index.js';
            $view_script_path = get_stylesheet_directory_uri() . '/template-parts/blocks/' . $folder . '/' . $folder . '-view.js';

            // Check and register editor script
            if (file_exists(get_stylesheet_directory() . '/template-parts/blocks/' . $folder . '/' . $folder . '-index.js')) {
                wp_register_script($editor_script_handle, $editor_script_path, array(), '1.0.0', true);
            }

            // Check and register view script
            if (file_exists(get_stylesheet_directory() . '/template-parts/blocks/' . $folder . '/' . $folder . '-view.js')) {
                wp_register_script($view_script_handle, $view_script_path, array(), '1.0.0', true);
            }
        }
    }
}
add_action('init', 'rtgt_register_acf_blocks');
