<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://datamad.co.uk
 * @since      2.0.0
 *
 * @package    Turbo_Widgets
 * @subpackage Turbo_Widgets/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Turbo_Widgets
 * @subpackage Turbo_Widgets/public
 * @author     DataMad Ltd, Todd Halfpenny <support@datamad.co.uk>
 */
class Turbo_Widgets_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    2.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    2.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * Initialize the class and set its properties.
     *
     * @since    2.0.0
     * @param      string $plugin_name       The name of the plugin.
     * @param      string $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        add_shortcode( 'turbo_widget', array( $this, 'turbo_widget' ) );
        add_shortcode( 'turbo_sidebar', array( $this, 'turbo_sidebar' ) );
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Our lovely turbo_widget shortcode handler
     *
     * @since 2.0.0
     * @param  string $atts Attributes passed to our shortcode.
     * @return string       Markup of our widget's output.
     */
    public function turbo_widget( $atts )
    {
        $turbo_sidebar = array(
            'name'          => 'Turbo Widgets Sidebar',
            'id'            => 'turbo-sidebar-1',
            'description'   => '',
            'class'         => '',
            'before_widget' => '<div class="widget turbo_widget">',
            'after_widget'  => '</div><!-- .turbo_widge -->',
            'before_title'  => '<h3 class="widget_title">',
            'after_title'   => '</h2>',
        );
        // From WP 4.2.7+ (maybe) the $atts changed.
        global  $wp_version ;
        
        if ( $wp_version < 4.3 ) {
            parse_str( htmlspecialchars_decode( $atts[0] ), $output );
        } else {
            $tmp_arr = array(
                0 => 'widget-prefix=' . $atts['widget-prefix'],
            );
            parse_str( htmlspecialchars_decode( $tmp_arr[0] ), $output );
        }
        
        $field_prefix = 'widget-' . $output['widget-prefix'] . '--';
        foreach ( $output as $i => $value ) {
            $is_meta = strstr( $i, $field_prefix );
            
            if ( false != $is_meta ) {
                $i = substr( $i, strlen( $field_prefix ) );
                $instance[$i] = $value;
            }
        
        }
        
        if ( !isset( $instance ) ) {
            $field_prefix = 'widget-' . $output['widget-prefix'] . '-';
            foreach ( $output as $i => $value ) {
                $is_meta = strstr( $i, $field_prefix );
                
                if ( false != $is_meta ) {
                    $i = substr( $i, strlen( $field_prefix ) );
                    // TODO Need to handle specific widgets / fields, for things like
                    // checkboxes and radio buttons. For Example Tag Cloud's "count" is 0 | 1,
                    // rather than "true" | "false"
                    // Prob need to handle each widget and it's field
                    
                    if ( array_key_exists( 'obj-class', $output ) ) {
                        
                        if ( $output['obj-class'] == 'WP_Widget_Archives' && $value == 'false' || $output['obj-class'] == 'WP_Widget_Categories' && $value == 'false' || $output['obj-class'] == 'WP_Widget_Recent_Posts' && $value == 'false' || $output['obj-class'] == 'WP_Widget_RSS' && $value == 'false' || $output['obj-class'] == 'WP_Widget_Tag_Cloud' && $value == 'false' ) {
                        } else {
                            $instance[$i] = $value;
                        }
                    
                    } else {
                        $instance[$i] = $value;
                    }
                
                }
            
            }
        }
        
        if ( !array_key_exists( 'obj-class', $output ) ) {
            // For some reason our array is cocked-up (semi-colon special char,)
            // only an issue on some vsn of PHP) we need to adjust the keys.
            foreach ( $output as $k => $v ) {
                unset( $output[$k] );
                $new_key = str_replace( '#038;', '', $k );
                $output[$new_key] = $v;
            }
        }
        
        if ( array_key_exists( 'display-callback', $output ) ) {
            /*
             * This widget does not extend WP_Widget - so we call it's callback.
             * Note. if we call this then the values set in our form are not used,
             * They get called from the Widget's own options.
             */
            if ( !is_callable( $output['display-callback'] ) ) {
                return '<!-- Turbo Widgets: No widget found with callback = ' . $output['display-callback'] . '-->';
            }
            $params = array();
            $params[0] = $turbo_sidebar;
            $params = apply_filters( 'dynamic_sidebar_params', $params );
            ob_start();
            call_user_func_array( $output['display-callback'], $params );
            $my_str = ob_get_contents();
            ob_end_clean();
            return $my_str;
        } else {
            $turbo_widget_class = $output['obj-class'];
            $widget = new $turbo_widget_class();
            ob_start();
            the_widget( $turbo_widget_class, $instance, $turbo_sidebar );
            $my_str = ob_get_contents();
            ob_end_clean();
            return $my_str;
        }
    
    }
    
    /**
     * Our lovely turbo_sidebar shortcode handler -> calls premium code
     *
     * @since 2.0.0
     * @param  string $atts Attributes passed to our shortcode.
     * @return string       Markup of our widget's output.
     */
    public static function turbo_sidebar( $atts )
    {
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    2.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Turbo_Widgets_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Turbo_Widgets_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/turbo-widgets-public.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    2.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Turbo_Widgets_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Turbo_Widgets_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'js/turbo-widgets-public.js',
            array( 'jquery' ),
            $this->version,
            false
        );
    }

}