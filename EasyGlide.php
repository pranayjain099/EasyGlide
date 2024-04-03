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

// defining ABSPATH for security purpose
if (!defined("ABSPATH")) {
    die(' hehehehehe');
}

// Defining class 
if (!class_exists('Easy_Glide')) {

    class Easy_Glide
    {
        function __construct()
        {
            $this->define_constant();

            // Adding menu in admin
            add_action('admin_menu', array($this, 'add_menu'));

            // Require Custom post type file
            require_once (EASY_GLIDE_PATH . 'post-types/class.easy-glide-cpt.php');
            $Easy_Glide_Post_Type = new Easy_Glide_Post_Type();

            // Require Settings file
            require_once (EASY_GLIDE_PATH . 'class.easy-glide-settings.php');
            $Easy_Glide_Settings = new Easy_Glide_Settings();
        }

        // Defining constants 
        public function define_constant()
        {
            define('EASY_GLIDE_PATH', plugin_dir_path(__FILE__));
            define('EASY_GLIDE_URL', plugin_dir_url(__FILE__));
            define('EASY_GLIDE_VERSION', '1.0.0');
        }
        public static function activate()
        {
            // Updating the option 'rewrite_rules' to an empty string during plugin activation is a common practice in WordPress plugin development. 
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

        // Callback function to add_menu in admin
        public function add_menu()
        {
            add_menu_page(
                'Easy Glide Options',    // Page title
                'Easy Glide',
                'manage_options',
                'easy_glide_admin',
                array($this, 'easy_glide_settings_page'),
                'dashicons-images-alt2'
            );

            // Submenu 1 = Opens the slider post type page
            add_submenu_page(
                'easy_glide_admin',
                'Manage Slides',
                'Manage Slides',
                'manage_options',
                'edit.php?post_type=easy-glide',
                null,    // Existing page so no callback function

            );

            // Submenu 2   = to add new post in slider 
            add_submenu_page(
                'easy_glide_admin',
                'Add New Slide',
                'Add New Slide',
                'manage_options',
                'post-new.php?post_type=easy-glide',
                null,   // Existing page so no callback function

            );
        }

        // Callback function of menu
        public function easy_glide_settings_page()
        {
            // Control access to our settings page , if user has direct link of settings page we should prevent him.
            if (!current_user_can('manage_options')) {
                return;
            }

            // Showing success message when data is saved 
            if (isset($_GET['settings-updated'])) {
                add_settings_error('easy_glide_options', 'easy_glide_message', 'Settings Saved', 'success');
            }

            // showing error message 
            settings_errors('easy_glide_options');

            // Whole content of settings page 
            require (EASY_GLIDE_PATH . 'views/settings-page.php');
        }

    }
}

if (class_exists('Easy_Glide')) {

    // takes two parameter path and an array which contains class name and funciton name.
    register_activation_hook(__FILE__, array('Easy_Glide', 'activate'));
    register_deactivation_hook(__FILE__, array('Easy_Glide', 'deactivate'));
    register_uninstall_hook(__FILE__, array('Easy_Glide', 'uninstall'));

    // Creating object of class
    $easy_glide = new Easy_Glide();
}
