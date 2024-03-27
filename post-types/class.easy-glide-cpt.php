<?php

if (!class_exists('Easy_Glide_Post_Type')) {
    class Easy_Glide_Post_Type
    {
        function __construct()
        {
            // Custom post type 
            add_action('init', array($this, 'create_post_type'));

            // Meta boxes
            add_action('add_meta_boxes', array($this, 'add_meta_boxes'));

            add_action('save_post', array($this, 'save_post'), 10, 2);
        }

        // Callback function of Custom post type
        public function create_post_type()
        {
            $labels =
                [
                    'name' => 'Sliders',
                    'singular_name' => 'Slider'
                ];

            // Arguments of post type
            $args =
                [
                    'labels' => $labels,
                    'description' => 'This will help you to create each item in the slideshow',
                    'public' => true,
                    'supports' => ['title', 'editor', 'thumbnail'],
                    'hierarchical' => false,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'can_export' => true,
                    'has_archive' => false,
                    'exclude_from_search' => false,
                    'publicly_queryable' => true,
                    'show_in_rest' => true,
                    'menu_icon' => 'dashicons-images-alt2'
                ];

            // Registering post type 
            register_post_type('easy-glide', $args);
        }

        // Callback function of Meta boxes
        public function add_meta_boxes()
        {
            add_meta_box(
                'easy_glide_meta_box',                  // Id 
                'Link Options',                         // Title
                array($this, 'add_inner_meta_boxes'),   // Callback function
                'easy-glide',                           // screen
                'normal',                               // Context
                'high'                                  // Priority
            );
        }

        // Callback function for Metabox html
        public function add_inner_meta_boxes($post)
        {
            require_once (EASY_GLIDE_PATH . 'views/easy-glide_metabox.php');
        }

        // Saving the data in wp_postmeta table
        public function save_post($post_id)
        {
            if (isset($_POST['action']) && $_POST['action'] == 'editpost') {

                // As we have two fields in the metabox so created 4 varible (2 for each) saving their old and new value in the variable.

                // Created a variable to store old value of the field if already exists in the table
                $old_link_text = get_post_meta($post_id, 'mv_slider_link_text', true);

                // Created a variable to store new value passed by the user in the admin screen.
                $new_link_text = $_POST['mv_slider_link_text'];

                // Same here
                $old_link_url = get_post_meta($post_id, 'mv_slider_link_url', true);
                $new_link_url = $_POST['mv_slider_link_url'];

                // Adding / updating data in the table for both the fields
                update_post_meta($post_id, 'mv_slider_link_text', $new_link_text, $old_link_text);
                update_post_meta($post_id, 'mv_slider_link_url', $new_link_url, $old_link_url);
            }
        }
    }
}
