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
            register_setting('easy_glide_group', 'easy_glide_options', array($this, 'easy_glide_validate'));

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
                'easy_glide_second_section',
                array(
                    'label_for' => 'easy_glide_title'
                )
            );

            // Field 2.2
            add_settings_field(
                'easy_glide_bullets',
                'Display Bullets',
                array($this, 'easy_glide_bullets_callback'),
                'easy_glide_page2',
                'easy_glide_second_section',
                array(
                    'label_for' => 'easy_glide_bullets'
                )
            );

            // Field 2.3
            add_settings_field(
                'easy_glide_style',
                'Slider Style',
                array($this, 'easy_glide_style_callback'),
                'easy_glide_page2',
                'easy_glide_second_section',
                array(
                    'items' => array(
                        'style-1',
                        'style-2'
                    ),
                    'label_for' => 'easy_glide_style'
                )
            );

        }


        // Callback function of field 1.1
        public function easy_glide_shortcode_callback()
        {
            ?>
            <span>Use the shortcode [easy_glide] to display the glide in any page/post/widget</span>
            <?php
        }

        // Callback function of field 2.1
        public function easy_glide_title_callback($args)
        {
            ?>
            <input type="text" name="easy_glide_options[easy_glide_title]" id="easy_glide_title"
                value="<?php echo isset(self::$options['easy_glide_title']) ? esc_attr(self::$options['easy_glide_title']) : ''; ?>">
            <?php
        }

        // Callback function of field 2.2
        public function easy_glide_bullets_callback($args)
        {
            ?>
            <input type="checkbox" name="easy_glide_options[easy_glide_bullets]" id="easy_glide_bullets" value="1" <?php
            if (isset(self::$options['easy_glide_bullets'])) {
                checked("1", self::$options['easy_glide_bullets'], true);
            }
            ?> />
            <label for="easy_glide_bullets">Whether to display bullets or not</label>

            <?php
        }

        // Callback function of field 2.3
        public function easy_glide_style_callback($args)
        {
            ?>
            <select id="easy_glide_style" name="easy_glide_options[easy_glide_style]">
                <?php
                foreach ($args['items'] as $item):
                    ?>
                    <option value="<?php echo esc_attr($item); ?>" <?php
                       isset(self::$options['easy_glide_style']) ? selected($item, self::$options['easy_glide_style'], true) : '';
                       ?>>
                        <?php echo esc_html(ucfirst($item)); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php
        }

        // Validating the input fields 
        public function easy_glide_validate($input)
        {
            $new_input = array();
            foreach ($input as $key => $value) {
                switch ($key) {
                    case 'easy_glide_title':

                        // If the input field is empty
                        if (empty($value)) {
                            $value = 'Please, type some text';
                        }
                        $new_input[$key] = sanitize_text_field($value);
                        break;
                    default:
                        $new_input[$key] = sanitize_text_field($value);
                        break;
                }
            }
            return $new_input;
        }
    }

}

