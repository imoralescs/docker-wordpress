<?php /* ==========================================================================
  GLOBAL
 ========================================================================== */

// enqueue scripts
function theme_scripts() {
 wp_enqueue_style('main', CSS_PATH . 'main.css');
// Use Google's CDN for jQuery
wp_deregister_script('jquery');
wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js", false, '2.1.0', false);
 wp_enqueue_script('jquery-mobile-events', JS_PATH . 'vendor/jquery.mobile.events.js', array("jquery"));
 wp_enqueue_script('main', JS_PATH . 'main.js', array("jquery-mobile-events"), "1.0", true);
}
if (!is_admin()) add_action("wp_enqueue_scripts", "theme_scripts", 11);

// theme support
add_theme_support('menus');
add_theme_support('post-thumbnails');

// add image size
set_post_thumbnail_size( 230, 248 ); // default Post Thumbnail dimensions
update_option('thumbnail_crop', 1);
add_image_size('bg-desktop', 1680, 1050, true);
add_image_size('bg-tablet', 768, 480, true);
add_image_size('bg-phone', 480, 300, true);

// Register Navigation Menus
function custom_navigation_menus() {

 $locations = array(
    'header_menu' => __( 'Header Menu', THEME_NAME ),
    'footer_menu' => __( 'Footer Menu', THEME_NAME ),
 );
 register_nav_menus( $locations );

}

// Hook into the 'init' action
add_action( 'init', 'custom_navigation_menus' );

// Register Sidebar
function custom_sidebars() {

 $blog = array(
    'id'            => 'blog_sidebar',
    'name'          => __( 'Blog Sidebar', THEME_NAME ),
    'class'         => 'blog-sidebar',
 );
 $subpage = array(
    'id'            => 'subpage_sidebar',
    'name'          => __( 'Subpage Sidebar', THEME_NAME ),
    'class'         => 'subpage-sidebar',
 );
 register_sidebar( $blog );
 register_sidebar( $subpage );

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'custom_sidebars' );

// Disable the Wordpress Admin Bar for all but admins.
if (!current_user_can('administrator')):
show_admin_bar(false);
endif;

function prevent_admin_access() {
  if (strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-admin') !== false && !current_user_can('administrator')) {
      wp_redirect( home_url() );
  }
}; ?>