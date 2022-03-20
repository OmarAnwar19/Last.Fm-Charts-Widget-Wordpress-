<div class="wrap">

    <h1><?php esc_html_e( get_admin_page_title(  ), "lastfm-charts"); ?></h1>

    <form action="options.php" method="POST">

        <?php settings_fields("plugin_settings"); ?>

        <?php do_settings_sections( "lastfm-charts" ); ?>

        <?php submit_button(); ?>

    </form>

</div>