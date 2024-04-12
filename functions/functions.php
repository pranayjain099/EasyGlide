<?php

// Function to control(visible / hidden) bullets on slideshow
if (!function_exists('easy_glide_options')) {
    function easy_glide_options()
    {
        // Fetching data
        $show_bullets = isset(Easy_Glide_Settings::$options['mv_slider_bullets']) && Easy_Glide_Settings::$options['mv_slider_bullets'] == 1 ? true : false;

        // Enqueue flex-slider script
        wp_register_script('easy-glide-options-js', EASY_GLIDE_URL . 'vendor/flexslider/flexslider.js', array('jquery'), EASY_GLIDE_VERSION, true);

        wp_localize_script('mv-slider-options-js', 'SLIDER_OPTIONS', array(
            'controlNav' => $show_bullets
        ));
    }
}
