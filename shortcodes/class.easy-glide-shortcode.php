<?php

if (!class_exists('Easy_Glide_Shortcode')) {
    class Easy_Glide_Shortcode
    {
        public function __construct()
        {
            // Shortode
            add_shortcode('easy_glide', array($this, 'add_shortcode'));
        }

        public function add_shortcode($atts = array(), $content = null, $tag = '')
        {

            // All attribute used in shortcode must be lower case.
            $atts = array_change_key_case((array) $atts, CASE_LOWER);

            // extracts the shortcode attributes
            extract(shortcode_atts(

                // Passing default value to the attribute , in case user do not provide any value then these value will be used.
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

            // user should pass the id value in interger only and seperated by comma.
            // If user pass something other then integer then this funtion will delete that information and leave it with integer only.
            if (!empty($id)) {
                $id = array_map('absint', explode(',', $id));
            }

            ob_start();

            require(EASY_GLIDE_PATH . 'views/easy-glide_shortcode.php');
            return ob_get_clean();
        }
    }
}
