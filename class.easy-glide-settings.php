<!-- Settigns page -->
<?php

if (!class_exists('Easy_Glide_Settings')) {
    class Easy_Glide_Settings
    {

        public static $options;

        public function __construct()
        {
            // $options will contains an array with all the values submitted by our form.
            self::$options = get_option('easy_glide_options');

            // Register sections and fields 
            add_action('admin_init', array($this, 'admin_init'));

        }


        // Register sections and fields 
        public function admin_init()
        {
            // Section 1
            add_settings_section(
                'easy_glide_main_section',
                'How does it work?',
                null,
                'easy_glide_page1'
            );


            // Field 1.1
            add_settings_field(
                'easy_glide_shortcode',
                'Shortcode',
                array($this, 'easy_glide_shortcode_callback'),
                'easy_glide_page1',
                'easy_glide_main_section'
            );
        }

        // Callback function of field
        public function easy_glide_shortcode_callback()
        {
            ?>
            <span>Use the shortcode [mv_slider] to display the slider in any page/post/widget</span>
            <?php
        }
    }

}

