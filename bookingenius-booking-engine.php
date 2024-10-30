<?php
/*
  Plugin Name: BookinGenius Booking Engine
  Plugin URI: http://admin.bookingenius.it
  Description: Integration widget for BookinGenius Booking Engine.
  BookinGenius is a commission free booking engine that can be connected into your Wordpress Site.
  Request a free trial account online at http://www.begenius.it
  Author: Begenius
  Version: 1.2
  Author URI: http://www.begenius.it
  Text Domain: bookingenius-booking-engine
  Domain Path: /languages
  Licence : GNU General Public License version 2 or later; http://www.gnu.org/licenses/gpl-2.0.html
  Copyright : Copyright (C) 2017 Begenius s.r.l. (http://www.begenius.it). All rights reserved.
 */
// Prohibit direct script loading
defined('ABSPATH') || die('No direct script access allowed!');


use Begenius\PluginFactory;


register_activation_hook(__FILE__, 'bgbe_bookingenius_install');
register_uninstall_hook(__FILE__, 'bgbe_bookingenius_remove');

add_action('admin_menu', 'bgbe_bookingenius_menu');
add_shortcode('bookingenius_bgform', 'bgbe_bookingenius_bgform');
add_action('init', 'bgbe_bookingenius_load_textdomain');
add_action('wp_enqueue_scripts', 'bgbe_bookingenius_enqueue_scripts');
add_action('customize_register', 'bgbe_bookingenius_customize_theme' );
add_action('customize_preview_init', 'bgbe_bookingenius_customize_preview' );
add_action('plugins_loaded', 'bgbe_bookingenius_init');

function bgbe_bookingenius_load_textdomain() {
  $plugin_dir = plugin_dir_path( __FILE__ );

  require_once($plugin_dir . DIRECTORY_SEPARATOR . 'init' . DIRECTORY_SEPARATOR . 'init.php');

  remove_all_filters('override_load_textdomain');
  load_plugin_textdomain( 'bookingenius-booking-engine', false, basename( dirname( __FILE__ ) ) . '/languages/' );
  add_filter('override_load_textdomain', function(){
    return true;
  });

}

function bgbe_bookingenius_customize_preview() {
  $plugin_url = plugin_dir_url( __FILE__ );
  wp_enqueue_script('bg-bookingenius-customize-preview', $plugin_url . 'assets/plugins/begenius/customize-preview.js', array( 'customize-preview', 'jquery' ));
}

function bgbe_bookingenius_customize_theme( $wp_customize ){

  $plugin = bgbe_plugin_factory('BookingEngine', 'Bookingenius');

  $plugin->options('form_styles')->load();

  $wp_customize->add_section('color-bookingenius-alpha', array(
    'title' => 'Bookingenius form',
    'capability' => 'edit_theme_options'));

  foreach ($plugin->options('form_styles')->values as $option) {

    $wp_customize->add_setting('bg_bookingenius_'.$option->name, array(
          'type' => 'option',
          'capability' => 'edit_theme_options',
          'transport' => 'postMessage',
          'default' => $option->value
    ));

    switch ($option->type) {
      case 'color':
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bookingenius-' . $option->name,
          array(
                  'label' => __($option->title, 'bookingenius-booking-engine'),
                  'section' => 'color-bookingenius-alpha',
                  'settings' => 'bg_bookingenius_'.$option->name,
                  'priority' => 1,
          )
          ));
      break;
      case 'dropdown':
        $wp_customize->add_control( 'bookingenius-' . $option->name, array(
          'type' => 'select',
          'priority' => 2,
          'section' => 'color-bookingenius-alpha',
          'settings' => 'bg_bookingenius_'.$option->name,
          'label' => __($option->title, 'bookingenius-booking-engine'),
          'choices' => $option->values
        ) );
      break;
    }
  }

}

function bgbe_plugin_factory($name, $namespace) {
  $plugin_url = plugin_dir_url( __FILE__ ) .  DIRECTORY_SEPARATOR;
  $plugin_dir = plugin_dir_path( __FILE__ )  . DIRECTORY_SEPARATOR;
  require_once($plugin_dir . DIRECTORY_SEPARATOR . 'init' . DIRECTORY_SEPARATOR . 'init.php');
  return PluginFactory::create($name, $namespace, $plugin_dir, $plugin_url);
}

function bgbe_bookingenius_menu() {
  $plugin = bgbe_plugin_factory('BookingEngine', 'Bookingenius');
}

function bgbe_bookingenius_init() {
  $plugin_dir = basename(dirname(__FILE__));
  load_plugin_textdomain( 'bookingenius-booking-engine', false, $plugin_dir . '/languages/');
}

function bgbe_bookingenius_install() {
  $plugin = bgbe_plugin_factory('BookingEngine', 'Bookingenius');
  foreach ($plugin->options() as $option) {
    $option->create();
  }
}

function bgbe_bookingenius_remove() {
  $plugin = bgbe_plugin_factory('BookingEngine', 'Bookingenius');
  foreach ($plugin->options() as $option) {
    $option->delete();
  }
}

function bgbe_bookingenius_enqueue_scripts() {
  $plugin = bgbe_plugin_factory('BookingEngine', 'Bookingenius');

  $plugin->enqueue_styles();
}

function bgbe_bookingenius_bgform($atts) {

  $plugin = bgbe_plugin_factory('BookingEngine', 'Bookingenius');
  $plugin->enqueue_scripts($atts);
  $plugin->display_form($atts);
}
