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
                'easy_glide_meta_box',
                'Link Options',
                array($this, 'add_inner_meta_boxes'),
                'easy-glide',
                'normal',
                'high'
            );
        }

        public function add_inner_meta_boxes($post)
        {

        }
    }
}