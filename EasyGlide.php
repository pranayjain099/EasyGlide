<?php
/*
 * Plugin Name:       EasyGlide
 * Plugin URI:        https://wordpress.com/
 * Description:       Slide-show
 * Version:           1.0
 * Requires at least: 5.6
 * Requires PHP:      7.2
 * Author:            Pranay Jain
 * Author URI:        https://pranayjain099.github.io/Mywebsite/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       easy-glide
 * Domain Path:       /languages
 */

if (!defined("ABSPATH")) {
    die (' hehehehehe');
}

if (!class_exists('Easy_Glide')) {

    class Easy_Glde
    {
        function __construct()
        {
            $this->define_constant();
        }

        public function define_constant()
        {
            define('EASY_GLIDE_PATH', plugin_dir_path(__FILE__));
            define('EASY_GLIDE_URL', plugin_dir_url(__FILE__));
            define('EASY_GLIDE_VERSION', '1.0.0');
        }
    }
}

if (class_exists('Easy_Glide')) {

    $easy_glide = new Easy_Glde();
}
