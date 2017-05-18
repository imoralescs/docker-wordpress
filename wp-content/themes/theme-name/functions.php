<?php /* ==========================================================================
    REQUIRES
   ========================================================================== */

// base path
//$base = TEMPLATEPATH . "/includes";

// vendor classes (example twitter/facebook php sdk)
//# require_once("$base/vendor/facebook.php");

// shared boilerplate
//require_once("$base/vars.php");
//require_once("$base/global.php");
//require_once("$base/util.php");

// module specific helpers and crazy logic
//require_once("$base/modules/example-module.php");

// Adding theme support menu.
add_theme_support('menus');

// Tell wordpress we have a menu, setup on in.
function register_theme_menus(){

  register_nav_menus(
    array(
      'primary-menu' => __('Primary Menu')
    )
  );
}

// Now init menu
add_action('init', 'register_theme_menus');

// Adding CSS.
function imm_theme_styles() {
  wp_enqueue_style('main_css', get_template_directory_uri() . '/assets/css/main.css');
}

add_action('wp_enqueue_scripts', 'imm_theme_styles');

// Adding Javascript
function imm_theme_js() {
  wp_enqueue_script('bundle_js', get_template_directory_uri(). '/assets/js/bundle.js','','',false);
}

add_action('wp_enqueue_scripts', 'imm_theme_js');
?>
