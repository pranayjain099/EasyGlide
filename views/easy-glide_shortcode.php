<!-- HTML of our slide show -->
<h3>
    <!-- If user do not pass any content we will show the title (user pass this title in our settings page ) -->
    <?php echo (!empty($content)) ? esc_html($content) : esc_html(Easy_Glide_Settings::$options['easy_glide_title']); ?>
</h3>

<div
    class="easy-glide flexslider <?php echo (isset(Easy_Glide_Settings::$options['easy_glide_style'])) ? esc_attr(Easy_Glide_Settings::$options['easy_glide_style']) : 'style-1'; ?>">
    <ul class="slides">
        <?php
        // Arguments to be passed in WP_Query object
        $args = array(
            'post_type' => 'easy-glide',
            'post_status' => 'publish',
            'post__in' => $id,
            'orderby' => $orderby
        );
        // Creating object of WP_QUERY
        $my_query = new WP_Query($args);

        // loop
        if ($my_query->have_posts()):
            while ($my_query->have_posts()):
                $my_query->the_post();

                // getting button data
                $button_text = get_post_meta(get_the_ID(), 'easy_glide_link_text', true);
                $button_url = get_post_meta(get_the_ID(), 'easy_glide_link_url', true);

                ?>
                <li>
                    <!-- Getting background image for each slide -->
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', array('class' => 'img-fluid'));
                    } else {
                        echo easy_glide_get_placeholder_image();
                    }

                    ?>
                    <div class="mvs-container">
                        <div class="slider-details-container">
                            <div class="wrapper">
                                <div class="slider-title">
                                    <!-- Title of the post -->
                                    <h2><?php the_title(); ?></h2>
                                </div>
                                <div class="slider-description">
                                    <!-- Description of the post . -->
                                    <div class="subtitle"><?php the_content(); ?></div>
                                    <a class="link"
                                        href="<?php echo esc_attr($button_url); ?>"><?php echo esc_html($button_text); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
            endwhile;
            // this is because we are changing the default wordpress query using a custom query. In order to not affect any other query that you might want to add on this same page or even not to affect other default queries that may be present on the same page where your shortcode will be running you need to reset the query.
            wp_reset_postdata();
        endif;
        ?>
    </ul>
</div>