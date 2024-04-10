<!-- HTML of our slide show -->

<h3>
    <?php echo (!empty($content)) ? esc_html($content) : esc_html(Easy_Glide_Settings::$options['easy_glide_title']); ?>
</h3>

<div class="easy-glide flexslider ">
    <ul class="slides">

        <?php
        // Arguments to be passed in WP_Query object
        $args = array(
            'post_type' => 'easy-glide',
            'post_status'   => 'publish',
            'post__in'  => $id,
            'orderby' => $orderby
        );


        // Creating object of WP_QUERY
        $my_query = new WP_Query($args);

        // loop
        if ($my_query->have_posts()) :
            while ($my_query->have_posts()) : $my_query->the_post();

                // getting button data
                $button_text = get_post_meta(get_the_ID(), 'easy_glide_link_text', true);
                $button_url = get_post_meta(get_the_ID(), 'easy_glide_link_url', true);

        ?>
                <li>
                    <!-- Getting background image for each slide -->
                    <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                    <div class="mvs-container">
                        <div class="slider-details-container">
                            <div class="wrapper">
                                <div class="slider-title">
                                    <!-- Title of the post -->
                                    <h2><?php the_title(); ?></h2>
                                </div>
                                <div class="slider-description">
                                    <!-- Description of the post. -->
                                    <div class="subtitle"><?php the_content(); ?></div>
                                    <a class="link" href="<?php echo esc_attr($button_url); ?>"><?php echo esc_html($button_text); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>
</div>