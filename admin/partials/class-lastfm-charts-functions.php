<?php

class plugin_functions {

    public function __construct() {
        $this->add_hooks();
    }

    public function add_settings_link( $links ) {
        $settings_link = '<a href="tools.php?page=lastfm-charts">'.__("Settings", 'lastfm-charts')."</a>";
        array_push($links, $settings_link);
        return $links;
    }

    public function add_hooks() {
        $plugin_filter = "plugin_action_links_".PLUGIN_PATH;
        add_filter( $plugin_filter , array($this,"add_settings_link") );
    }

}