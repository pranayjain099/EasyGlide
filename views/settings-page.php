<!-- Building the whole content of settings page -->


<!-- Creating form and this form will submit the information of our settings page to database -->

<div class="wrap">
    <h1>
        <!-- get_admin_page_title() will return the page title which we defined when were creating menu-->
        <?php echo esc_html(get_admin_page_title()); ?>
    </h1>

    <!-- Tabs -->
    <?php
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'main_options';
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=easy_glide_admin&tab=main_options"
            class="nav-tab <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Main Options', 'easy-glide'); ?></a>
        <a href="?page=easy_glide_admin&tab=additional_options"
            class="nav-tab <?php echo $active_tab == 'additional_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Additional Options', 'easy-glide'); ?></a>
    </h2>

    <!-- options.php file is responsible for processing all forms in wordpress admin-->
    <form action="options.php" method="post">
        <?php
        if ($active_tab == 'main_options') {
            settings_fields('easy_glide_group');
            do_settings_sections('easy_glide_page1');
        } else {
            settings_fields('easy_glide_group');
            do_settings_sections('easy_glide_page2');
        }
        submit_button(esc_html__('Save Settings', 'easy-glide'));
        ?>
    </form>
</div>