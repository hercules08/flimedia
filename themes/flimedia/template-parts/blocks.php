<?php
/**
 * We register our block's with WordPress's handy
 * register_block_type();
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_type/
 */

function rtgt_register_acf_blocks() {
    if ( ! function_exists( 'register_block_type' ) ) {
        // Block editor is not available.
        return;
    }

    $blocks_dir = __DIR__ . '/blocks';
    $block_folders = scandir($blocks_dir);

    foreach ($block_folders as $folder) {
        if ($folder === '.' || $folder === '..') {
            continue; // Skip current and parent directory references
        }

        $block_path = $blocks_dir . '/' . $folder;
        if (is_dir($block_path)) {
            register_block_type($block_path, [
                'icon' => '<svg id="flimedia" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 219.82 200.48"><g id="flimedia_1"><path d="M42.94,200.41H7.91c-4.36,0-7.89-3.53-7.89-7.89,0-.22,0-.45,0-.67,0-52.28-.05-104.56.02-156.84C.08,4.2,4.24.07,34.73.02,56.57-.01,160.34,0,202.49,0c9.57,0,17.33,7.76,17.33,17.33v29.07c0,7.5-6.07,13.58-13.57,13.58-37.1,0-128.8-.01-143.15,0-2.08,0-3.89,1.3-5.39,3.11-3.98,4.8-.98,12.1,5.21,12.83,15.16,1.78,108.91.68,140.32.7,7.5,0,13.58,6.09,13.58,13.59,0,7.5-6.07,13.58-13.56,13.58-44.68.04-92-.06-137.32-.06-12.37,0-14,5-14.54,16.02-.23,4.61-.72,53.25-.56,72.69.04,4.38-3.51,7.95-7.89,7.95Z"/><path d="M139.98,167.21c4.8-12.3,9.6-24.6,14.42-36.9,1.26-3.21,2.29-6.44,3.92-9.61,2.16-4.22,8.23-6.82,17.95-7.03,12.23-.27,24.51-.11,37.27-.08,2.06,0,3.74.73,3.74,1.62v57.39c0,15.2-12.32,27.52-27.52,27.52h-18.86v-25.51c0-.83-.65-1.52-1.48-1.56h0c-.63-.03-1.22.32-1.49.89-.89,1.86-1.83,3.71-2.55,5.58-2.29,5.9-4.72,11.8-6.53,17.73-.74,2.43-2.78,3.34-8.54,3.22-8.03-.16-16.09-.09-24.8-.06-3.04,0-5.78-1.85-6.88-4.68-3.05-7.82-6.99-17.94-8.35-21.42-.28-.72-1.03-1.13-1.79-.99h0c-.76.14-1.31.81-1.31,1.58v25.25s-47.9,0-47.9,0v-72.98c0-2.27-1.33-13.4,3.4-13.57,6.95-.24,22.27.16,41.65.32,10.05.08,14.34,4.18,15.96,8.39,5.27,13.73,10.71,27.45,16.11,41.17.5,1.27,1.19,2.52,1.79,3.79l1.82-.05Z"/></g></svg>'
              ]);
            
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