<?php

// Shortcode class
if (!class_exists('Easy_Glide_Shortcode')) {
    class Easy_Glide_Shortcode
    {
        public function __construct()
        {
            // Registering Shortode
            add_shortcode('easy_glide', array($this, 'add_shortcode'));
        }

        public function add_shortcode($atts = array(), $content = null, $tag = '')
        {

            // All attribute used in shortcode must be lower case.
            $atts = array_change_key_case((array) $atts, CASE_LOWER);

            // extracts the shortcode attributes
            extract(shortcode_atts(

                // default value to the attribute 
                array(
                    // Id of the slide
                    'id' => '',

                    // To chose order of their presentation
                    'orderby' => 'date'
                ),

                // Attributes provided by user.
                $atts,
                // this allows us to create a specific filter for our shortcode.
                $tag
            ));

            // user should pass the slide id  seperated by comma.
            // Absint function make sure that id passed by user is interger. If user pass something other then integer then this funtion will delete that information and leave it with integer only.
            if (!empty($id)) {
                $id = array_map('absint', explode(',', $id));
            }

            // Takes all the html ouput and pass to buffer
            ob_start();

            // Require the html view
            require(EASY_GLIDE_PATH . 'views/easy-glide_shortcode.php');

            // Enqueue scripts
            wp_enqueue_script('easy-glide-main-jq');

            // Enqueue styles
            wp_enqueue_style('easy-glide-main-css');
            wp_enqueue_style('easy-glide-style-css');


            // Function to control bullet display on slide show
            easy_glide_options();

            // Returns the html output.
            return ob_get_clean();
        }
    }
}
