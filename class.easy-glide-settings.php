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

        }

    }
}

