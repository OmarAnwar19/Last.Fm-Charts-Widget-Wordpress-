<?php
 
/**
 * Adds Music_Charts widget.
 */
class Music_Charts extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'music_charts', // Base ID
            'Last.Fm Music Charts', // Name
            array( 'description' => __( 'Insert a lastfm Music Chart using the appropriatley named widget.', 'lastfm-charts' ), ) // Args
        );
    }
 
    //With api
    public function get_chart( $chart ) {
        $options = get_option( 'plugin_settings' );
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $api_key = $options[ 'lastfm_charts_api_key' ];
        $fetch_url = "http://ws.audioscrobbler.com/2.0/?method=chart.gettop". $chart ."&api_key=". $api_key ."&format=json&limit=50";

        curl_setopt_array($curl, [
            CURLOPT_URL => $fetch_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $res = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) return $err;
        return $res;

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );

        $options = get_option( 'plugin_settings' );
        $curr_chart = $instance['curr_chart'];
        $chart_data = json_decode($this->get_chart($curr_chart), TRUE);

        echo $before_widget;

        if( !isset( $options[ 'lastfm_charts_api_key' ] ) || $options[ 'lastfm_charts_api_key' ] === ""  ) {
            esc_html_e("Error. No API Key set.", "lastfm-charts"); die;
        }

        if ($chart_data["message"]) {
            esc_html_e("Error. Invalid API Key.", "lastfm-charts"); die;
        }

        //Include our chart template
        set_query_var( 'chart_data', $chart_data );

        if ($curr_chart === "tracks") include (plugin_dir_path( __FILE__ ) . "public/templates/class-chart-tracks.php");
        if ($curr_chart === "artists") include (plugin_dir_path( __FILE__ ) . "public/templates/class-chart-artists.php");
        if ($curr_chart === "tags") include (plugin_dir_path( __FILE__ ) . "public/templates/class-chart-tags.php");

        echo $after_widget;
    }
 
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $curr_chart = esc_attr($instance['curr_chart']);

        ?>
        <p id="chart_select_group">
            <h5><?php esc_html_e( "Select Chart:", "lastfm-charts" ); ?></h5>

            <input type="radio" 
                   id="<?php echo $this->get_field_id('top_tracks'); ?>" 
                   name="<?php echo $this->get_field_name('curr_chart'); ?>" 
                   value="tracks" 
                   <?php if ($curr_chart === 'tracks') echo 'checked="checked"'; ?>>
            <label for="<?php echo $this->get_field_id('curr_chart'); ?>"><?php esc_html_e('Top Tracks', "lastfm-charts"); ?><br>

            <input type="radio" 
                   id="<?php echo $this->get_field_id('top_artists'); ?>" 
                   name="<?php echo $this->get_field_name('curr_chart'); ?>" 
                   value="artists" 
                   <?php if ($curr_chart === 'artists') echo 'checked="checked"'; ?>>
            <label for="<?php echo $this->get_field_id('curr_chart'); ?>"><?php esc_html_e('Top Artists', "lastfm-charts"); ?><br>

            <input type="radio" 
                   id="<?php echo $this->get_field_id('top_tags'); ?>" 
                   name="<?php echo $this->get_field_name('curr_chart'); ?>" 
                   value="tags" 
                   <?php if ($curr_chart === 'tags') echo 'checked="checked"'; ?>>
            <label for="<?php echo $this->get_field_id('curr_chart'); ?>"><?php esc_html_e('Top Tags', "lastfm-charts"); ?><br>
        </p>
    <?php
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['curr_chart'] = strip_tags($new_instance['curr_chart']);
        
        return $instance;
    }
 
} // class Music_Charts

//Initializing our widget
class Widget_Init {

    //Register widgets function
    function reg_widgets() { 

        //Registering our Music_Charts
        register_widget( 'Music_Charts' ); 
    
    }

    //Add widget styles function
    function enqueue_styles() {

        //Enquing our widget styles
        wp_enqueue_style( "widget-styles", plugin_dir_url( __FILE__ ) . 'public/css/lastfm-charts-public.css', array(), "1.0.0", 'all' );

    }
    
}