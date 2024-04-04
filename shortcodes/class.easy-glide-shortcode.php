<?php 

if( ! class_exists('Easy_Glide_Shortcode')){
    class Easy_Glide_Shortcode{
        public function __construct(){

            // Shortode
            add_shortcode( 'easy_glide', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = '' ){

            // Only lowercase letters
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );

            // extracts the shortcode attributes
            extract( shortcode_atts(
                array(
                    'id' => '',
                    'orderby' => 'date'
                ),
                $atts,
                $tag
            ));

            if( !empty( $id ) ){
                $id = array_map( 'absint', explode( ',', $id ) );
            }
        }
    }
}