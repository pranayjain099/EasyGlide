<?php

// Default image to show if no case of no post
if (!function_exists('easy_glide_get_placeholder_image')) {
    function easy_glide_get_placeholder_image()
    {
        return "<img src='" . EASY_GLIDE_URL . "assets/images/default.jpg' class='img-fluid wp-post-image' />";
    }
}

// Function to control(visible / hidden) bullets on slideshow
if (!function_exists('easy_glide_options')) {
    function easy_glide_options()
    {
        // Fetching data
        $show_bullets = isset(Easy_Glide_Settings::$options['easy_glide_bullets']) && Easy_Glide_Settings::$options['easy_glide_bullets'] == 1 ? true : false;

        // Enqueue flex-slider script
        wp_enqueue_script('mv-slider-options-js', EASY_GLIDE_URL . 'vendor/flexslider/flexslider.js', array('jquery'), EASY_GLIDE_VERSION, true);

        wp_localize_script(
            'mv-slider-options-js',
            'SLIDER_OPTIONS',
            array(
                'controlNav' => $show_bullets
            )
        );
    }
}

