<?php
// Displaying the data in the fields of metabox

$meta = get_post_meta($post->ID);

// Retrieving the text 
$link_text = get_post_meta($post->ID, 'easy_glide_link_text', true);

// Retrieving the url
$link_url = get_post_meta($post->ID, 'easy_glide_link_url', true);

?>
<table class="form-table mv-slider-metabox">
    <tr>
        <th>
            <label for="easy_glide_link_text">Link Text</label>
        </th>
        <td>
            <input type="text" name="easy_glide_link_text" id="easy_glide_link_text" class="regular-text link-text"
                value="<?php echo (isset($link_text)) ? $link_text : ''; ?>" required>
        </td>
    </tr>
    <tr>
        <th>
            <label for="easy_glide_link_url">Link URL</label>
        </th>
        <td>
            <input type="url" name="easy_glide_link_url" id="easy_glide_link_url" class="regular-text link-url"
                value="<?php echo (isset($link_url)) ? $link_url : ''; ?>" required>
        </td>
    </tr>
</table>