<?php
/**
 * Plugin Name: Mr. Mortgage
 * Plugin URI: https://github.com/KrashKartMedia/
 * Description: Display mortgage rates on your WordPress site via shortcodes, directly from loansifter. An active <a href="https://www.loansifter.com/home">loansifter.com</a> account is required.
 * Version: 1.0
 * Author: Russell Aaron
 * Author URI: http://russellaaron.vegas
 * Text Domain: mr-mortgage-wp
 * License: GPL2
 */
if ( ! defined( 'ABSPATH' ) ) {exit;}
//do text in shortcode
add_filter('widget_text', 'do_shortcode');
//code used from Hugh Lashbrooke - http://www.hughlashbrooke.com/2012/07/wordpress-add-plugin-settings-link-to-plugins-page/
  function mrforwp_settings_link( $links ) {
  $settings_link = '<a href="/wp-admin/options-general.php?page=mortgage-rates-for-wordpress">' . __( 'Settings' ) . '</a>';
      array_push( $links, $settings_link );
    	return $links;
  }
  $plugin = plugin_basename( __FILE__ );
  add_filter( "plugin_action_links_$plugin", 'mrforwp_settings_link' );
include 'settings-page.php';
include 'shortcodes.php';
?>