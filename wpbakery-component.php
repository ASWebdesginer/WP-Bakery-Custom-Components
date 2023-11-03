<?php

/*
Plugin Name: WP WPBakery Component
Plugin URI: https://example.com/
Description: Creates a custom component for WPBakery Page Builder.
Version: 1.0.1
Author: Your Name
Author URI: https://example.com/
*/

if (!defined('ABSPATH')) {
    die('-1');
}


class DefaultChecks{
        // ...
        function __construct() {
            add_action( 'init', array( $this, 'check_if_vc_is_install' ) );
            add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
            vc_add_shortcode_param('my_param', array($this,'custom_vc_button_field'));
        }    
        public function enqueue_admin_assets($hook) {
            // Enqueue assets on specific admin pages if needed
            wp_enqueue_style('sascs', plugin_dir_url(__FILE__) . 'assets/style.css', array(), '2.9');
            wp_enqueue_script('sascript', plugin_dir_url(__FILE__) . 'assets/script.js', array('jquery'), '1.7', true);
      
        }
        function check_if_vc_is_install(){
            if ( ! defined( 'WPB_VC_VERSION' ) ) {
                // Display notice that Visual Compser is required
                add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
                return;
            }
            else{
                require_once('sascomponents/Documentlinks.php');
            }			
        }
        function showVcVersionNotice(){
            ?>
            <div class="notice notice-warning is-dismissible">
                <p>Please install <a href="https://1.envato.market/A1QAx">WPBakery Page Builder</a> to use Mega Addons.</p>
            </div>
            <?php
        }    
      
        
            function custom_vc_button_field($settings, $value) {
                return '<div class="my_param_block">'
                .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value hidethisinput wpb-textinput ' .
                esc_attr( $settings['param_name'] ) . ' ' .
                esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />'
                .'</div>'
                .'<button class="mediabtn"><i class="fa fa-upload"></i> Add Media</button>';
            }
}

 new DefaultChecks();
 

