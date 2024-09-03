<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'ct-main-styles','ct-admin-frontend-styles' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

 


/*****************************
 * BEGIN ENQUEUE CPT & BLOCKS 
 *****************************/

// Custom Post Types
require get_stylesheet_directory() . '/inc/cpt.php';

// Blocks
require get_stylesheet_directory() . '/template-parts/blocks.php';

// END ENQUEUE CPT & BLOCKS




/*************************************
 * BEGIN ENQUEUE FOUNDATION FRAMEWORK
 *************************************/

function my_theme_enqueue_styles() {
    wp_enqueue_style('foundation', get_template_directory_uri() . '/build/style.css');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');




/*******************
 * BEGIN LOAD FONTS 
 *******************/

// Enqueue the parent theme stylesheet
function blocksy_child_enqueue_styles() {
    wp_enqueue_style( 'blocksy-parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'blocksy_child_enqueue_styles' );

// Adobe Fonts
function blocksy_child_enqueue_adobe_fonts() {
    wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/uux3oog.css' );
}
add_action( 'wp_enqueue_scripts', 'blocksy_child_enqueue_adobe_fonts' );

// Google Fonts
function blocksy_child_enqueue_google_fonts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'blocksy_child_enqueue_google_fonts' );

// END LOAD FONTS
    
    


/*************************
 * BEGIN DISABLE COMMENTS 
 *************************/

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
     
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
 
    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
 
    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
 
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
 
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
 
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
 
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

// END DISABLE COMMENTS