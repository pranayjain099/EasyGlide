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

    class Easy_Glide
    {
        function __construct()
        {

            $this->define_constant();

            // Require Custom post type file
            require_once (EASY_GLIDE_PATH . 'post-types/class.easy-glide-cpt.php');
            $Easy_Glide_Post_Type = new Easy_Glide_Post_Type();
        }

        public static function activate()
        {
            /**
             * Updating the option 'rewrite_rules' to an empty string during plugin activation is a common practice in WordPress plugin development. By updating the 'rewrite_rules' option to an empty string you're essentially triggering WordPress to rebuild the rewrite rules from scratch. This ensures that any custom rewrite rules added by your plugin are properly incorporated into the system.
             * do not worry as soon as you will save a post these rules will be recovered again.
             */
            update_option('rewrite_rules', '');
        }

        public static function deactivate()
        {
            //  it flushes the rewrite rules.

            flush_rewrite_rules();

            // Unregister custom post type
            unregister_post_type('easy-glide');
        }

        public static function uninstall()
        {

        }


        // Defining constants 
        public function define_constant()
        {
            define('EASY_GLIDE_PATH', plugin_dir_path(__FILE__));
            define('EASY_GLIDE_URL', plugin_dir_url(__FILE__));
            define('EASY_GLIDE_VERSION', '1.0.0');
        }
    }
}

if (class_exists('Easy_Glide')) {

    // takes two parameter path and an array which contains class name and funciton name.
    register_activation_hook(__FILE__, array('Easy_Glide', 'activate'));
    register_deactivation_hook(__FILE__, array('Easy_Glide', 'deactivate'));
    register_uninstall_hook(__FILE__, array('Easy_Glide', 'uninstall'));
    $easy_glide = new Easy_Glide();
}
