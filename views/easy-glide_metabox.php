<?php
// Displaying the data in the fields of metabox

$meta = get_post_meta($post->ID);

// Retrieving the text 
$link_text = get_post_meta($post->ID, 'easy_glide_link_text', true);

// Retrieving the url
$link_url = get_post_meta($post->ID, 'easy_glide_link_url', true);

?>

<!-- HTMl Form  -->
<table class="form-table easy-glide-metabox">

    <!--  Hidden NONCE created -->
    <input type="hidden" name="easy_glide_nonce" value="<?php echo wp_create_nonce("easy_glide_nonce"); ?>">

    <!-- Table -->
    <tr>
        <th>
            <label for="easy_glide_link_text"><?php _e('Link Text', 'easy-glide') ?></label>
        </th>
        <td>
            <input type="text" name="easy_glide_link_text" id="easy_glide_link_text" class="regular-text link-text" value="<?php echo (isset($link_text)) ? esc_html($link_text) : ''; ?>" required>
        </td>
    </tr>
    <tr>
        <th>
            <label for="easy_glide_link_url"><?php _e('Link URL', 'easy-glide') ?></label>
        </th>
        <td>
            <input type="url" name="easy_glide_link_url" id="easy_glide_link_url" class="regular-text link-url" value="<?php echo (isset($link_url)) ? esc_url($link_url) : ''; ?>" required>
        </td>
    </tr>
</table>