
<!-- HTML of our slide show -->

<h3>
    <?php 
        echo ( ! empty ( $content ) ) ? esc_html( $content ) : esc_html( Easy_Glide_Settings::$options['easy_glide_title'] ); 
    ?>
</h3>
<div class="easy_glide flexslider ">
    <ul class="slides">
        <li>
            <div class="easy_glide-container">
                <div class="slider-details-container">
                    <div class="wrapper">
                        <div class="slider-title">
                            <h2>Slider Title</h2>
                        </div>
                        <div class="slider-description">
                            <div class="subtitle">Subtitle</div>
                            <a class="link" href="#">Button text</a>
                        </div>
                    </div>
                </div>              
            </div>
        </li>
    </ul>
</div>