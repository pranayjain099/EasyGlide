<!-- Building the whole content of settings page -->


<!-- Creating form and this form will submit the information of our settings page to database -->

<div class="wrap">
    <h1>
        <!-- get_admin_page_title() will return 'Easy Glide Options' this is the menu title (first parameter) which we defined when were creating menu-->
        <?php echo esc_html(get_admin_page_title()); ?>
    </h1>

    <!-- options.php file is responsible for processing all forms in wordpress admin-->
    <form action="options.php" method="post">
        <?php
        settings_fields('easy_glide_group');
        do_settings_sections('easy_glide_page1');
        do_settings_sections('easy_glide_page2');
        submit_button('Save Settings');
        ?>


    </form>
</div>