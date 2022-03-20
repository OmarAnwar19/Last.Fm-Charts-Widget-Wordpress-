<?php

/**
 * Set up a settings section
 *
 * @link       N/A
 * @since      1.0.0
 *
 * @package    lasfm_Charts
 * @subpackage lasfm_Charts/admin/partials
 */

class plugin_settings_config {

    public function __construct() {

        $this->define_hooks();

    }

    public function plugin_settings_menus() {
        add_submenu_page(
            "tools.php",                                    
            __("Last.Fm Charts Settings", "lastfm-charts"),          
            __("Last.Fm Charts Settings", "lastfm-charts"),           
            "manage_options",                               
            "lastfm-charts",                                    
            array($this,"submenu_cb"),                                   
            100                                             
        );                                                  
    }
    
    public function submenu_cb() {
        if (!current_user_can("manage_options")) return;
    
        include (plugin_dir_path(dirname(__FILE__)) . "templates/settings-page.php");
    }

    public function plugin_settings_fields() {

        // If plugin settings don't exist, then create them
        if( false == get_option( 'plugin_settings' ) ) {
            add_option( 'plugin_settings' );
        }
      
        // Define (at least) one section for our fields
        add_settings_section(
          'plugin_settings_section',
          null,
          array($this,'plugin_settings_section_cb'),
          'lastfm-charts'
        );
      
        // Input Text Field
        add_settings_field(
          'plugin_settings_input_text',
          __( 'API Key', 'lastfm-charts'),
          array($this,'input_api_key_cb'),
          'lastfm-charts',
          'plugin_settings_section'
        );

        register_setting(
          'plugin_settings',
          'plugin_settings'
        );
      
      }
      
    public function plugin_settings_section_cb() {
      
        esc_html_e( 'Enter your Last.Fm API Key, to use the widget.', 'lastfm-charts' );
        
        ?><br><p><?php _e("Don't have a key?", "lastfm-charts"); ?> <a href="https://www.last.fm/api/account/create"><?php _e( "Get API Key.", "lastfm-charts" ); ?></a></p><?php
    }
      
    public function input_api_key_cb() {
      
        $options = get_option( 'plugin_settings' );
      
        $lastfm_charts_api_key = '';
        if( isset( $options[ 'lastfm_charts_api_key' ] ) ) {
            $lastfm_charts_api_key = esc_html( $options['lastfm_charts_api_key'] );
        }
      
        echo '<input type="text" id="lastfm_charts_api_key" name="plugin_settings[lastfm_charts_api_key]" value="' . $lastfm_charts_api_key . '" style="width: 250px;" /><br>';

    }
      
    public function define_hooks() {
        add_action( "admin_menu", array($this,"plugin_settings_menus"));
        add_action( 'admin_init', array($this,'plugin_settings_fields'));
    }

}
