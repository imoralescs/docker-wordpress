<?php /* ==========================================================================
    VARS
   ========================================================================== */

define("ASSETS_PATH", get_bloginfo('template_url') . '/assets/');
define("CSS_PATH", ASSETS_PATH . 'css/');
define("JS_PATH", ASSETS_PATH . 'js/');
define("SERVER_PROTOCOL", (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"); ?>