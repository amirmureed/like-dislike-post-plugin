<?php
/**
 * Plugin Name:       Like Dislike Post
 * Description:       Use this plugin to add like and dislike feature in your website. You can collect your audience feedback.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Amir Sandila
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if(!defined('WPINC')){
  die();
}

if(!defined('applicon_plugin_directory')){
  define('applicon_plugin_directory', plugin_dir_url(__FILE__));
  define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

if(!function_exists('applicon_plugin_scripts')){
  function applicon_plugin_scripts(){
    wp_enqueue_style( 'main-css',  applicon_plugin_directory. 'asset/css/style.css');
    wp_enqueue_script( 'main-js', applicon_plugin_directory. 'asset/js/script.js', array('jquery') );
    wp_localize_script( 'main-js', 'wpajax', array(
      'url' => admin_url( 'admin-ajax.php' )
    ));
  }

  add_action( 'wp_enqueue_scripts', 'applicon_plugin_scripts' );

}

// settings page
include(PLUGIN_DIR_PATH.'inc/settings.php');

// Database
include(PLUGIN_DIR_PATH.'inc/db.php');

// get btns value on front end
include(PLUGIN_DIR_PATH.'inc/btns.php');


// ajax handling php
include(PLUGIN_DIR_PATH.'inc/ajax-handle-like.php');

// ajax handling php
include(PLUGIN_DIR_PATH.'inc/ajax-handle-dislike.php');

?>