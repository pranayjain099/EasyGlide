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
            // Registering the settings 
            register_setting('easy_glide_group', 'easy_glide_options');

            // Section 1
            add_settings_section(
                'easy_glide_main_section',
                'How does it work?',
                null,
                'easy_glide_page1'
            );

            // Section 2
            add_settings_section(
                'easy_glide_second_section',
                'Other Plugin Options',
                null,
                'easy_glide_page2'
            );


            // Field 1.1
            add_settings_field(
                'easy_glide_shortcode',
                'Shortcode',
                array($this, 'easy_glide_shortcode_callback'),
                'easy_glide_page1',
                'easy_glide_main_section'
            );

            // Field 2.1
            add_settings_field(
                'easy_glide_title',
                'Slider Title',
                array($this, 'easy_glide_title_callback'),
                'easy_glide_page2',
                'easy_glide_second_section'
            );

            // Field 2.2
            add_settings_field(
                'easy_glide_bullets',
                'Display Bullets',
                array($this, 'easy_glide_bullets_callback'),
                'easy_glide_page2',
                'easy_glide_second_section'
            );

            // Field 2.3
            add_settings_field(
                'easy_glide_style',
                'Slider Style',
                array($this, 'easy_glide_style_callback'),
                'easy_glide_page2',
                'easy_glide_second_section'
            );

        }


        // Callback function of field 1.1
        public function easy_glide_shortcode_callback()
        {
            ?>
            <span>Use the shortcode [easy_glide] to display the slider in any page/post/widget</span>
            <?php
        }

        // Callback function of field 2.1
        public function easy_glide_title_callback()
        {
        }

        // Callback function of field 2.2
        public function easy_glide_bullets_callback()
        {
        }

        // Callback function of field 2.3
        public function easy_glide_style_callback()
        {
        }
    }

}

