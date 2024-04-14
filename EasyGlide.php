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

            $this->load_textdomain();
            // Require functions file
            require_once (EASY_GLIDE_PATH . 'functions/functions.php');

            // Adding menu in admin
            add_action('admin_menu', array($this, 'add_menu'));

            // Require Custom post type file
            require_once (EASY_GLIDE_PATH . 'post-types/class.easy-glide-cpt.php');
            $Easy_Glide_Post_Type = new Easy_Glide_Post_Type();

            // Require Settings file
            require_once (EASY_GLIDE_PATH . 'class.easy-glide-settings.php');
            $Easy_Glide_Settings = new Easy_Glide_Settings();

            // Require Shortcode file
            require_once (EASY_GLIDE_PATH . 'shortcodes/class.easy-glide-shortcode.php');
            $Easy_Glide_Shortcode = new Easy_Glide_Shortcode();

            // Enqueue scripts in frontend
            add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 999);

            // Enqueue scripts in backend
            add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));
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

        // Loads the translation files
        public function load_textdomain()
        {
            load_plugin_textdomain(
                'easy-glide',
                false,
                dirname(plugin_basename(__FILE__)) . '/languages/'
            );
        }

        // Callback function to add_menu in admin
        public function add_menu()
        {
            add_menu_page(
                esc_html__('Easy Glide Options', 'easy-glide'),    // Page title
                'Easy Glide',
                'manage_options',
                'easy_glide_admin',
                array($this, 'easy_glide_settings_page'),
                'dashicons-images-alt2'
            );

            // Submenu 1 = Opens the slider post type page
            add_submenu_page(
                'easy_glide_admin',
                esc_html__('Manage Slides', 'easy-glide'),
                esc_html__('Manage Slides', 'easy-glide'),
                'manage_options',
                'edit.php?post_type=easy-glide',
                null,
                null,

            );

            // Submenu 2   = to add new post in slider 
            add_submenu_page(
                'easy_glide_admin',
                esc_html__('Add New Slide', 'easy-glide'),
                esc_html__('Add New Slide', 'easy-glide'),
                'manage_options',
                'post-new.php?post_type=easy-glide',
                null,
                null,

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
                add_settings_error('easy_glide_options', 'easy_glide_message', esc_html__('Settings Saved', 'easy-glide'), 'success');
            }

            // showing error message 
            settings_errors('easy_glide_options');

            // Whole content of settings page 
            require (EASY_GLIDE_PATH . 'views/settings-page.php');
        }

        // Enqueue scripts in frontend
        public function register_scripts()
        {
            // Enqueue script
            wp_register_script('easy-glide-main-jq', EASY_GLIDE_URL . 'vendor/jquery.flexslider-min.js', array('jquery'), EASY_GLIDE_VERSION, true);

            // Enqueue Styles
            wp_register_style('easy-glide-main-css', EASY_GLIDE_URL . 'vendor/flexslider.css', array(), EASY_GLIDE_VERSION, 'all');

            wp_register_style('easy-glide-style-css', EASY_GLIDE_URL . 'assets/css/frontend.css', array(), EASY_GLIDE_VERSION, 'all');
        }

        // Enqueue scripts in backend
        public function register_admin_scripts()
        {
            global $typenow;
            if ($typenow == 'easy-glide') {
                wp_enqueue_style('easy-glide-admin', EASY_GLIDE_URL . 'assets/css/admin.css');
            }
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
