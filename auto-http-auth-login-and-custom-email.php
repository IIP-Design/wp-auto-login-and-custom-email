<?php
/**
 * Plugin Name: Seamless HTTP login and custom user notification email
 * Description: Automatically logs user in via the $_SERVER['REMOTE_USER'] environmental variable if it is set to the user's registered email address and overwrites the pluggable 'wp_new_user_notification()' function to allow the sending of a custom email due to user credentials not being necessary.
 * Author: Scott Gustas
 * Version: 0.1
 */

/**
 *
 * Note: The first version of this plugin will only hide the typical WordPress login form.
 *
 */
function custom_login() {
  //If the Google Apps Login is activated, let's hide the login form
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  wp_register_style( 'custom-login-styles', plugins_url('custom-login-styles.css', __FILE__) );
  $requiredplugin = 'google-apps-login/google_apps_login.php';
  if ( is_plugin_active($requiredplugin) )
    wp_enqueue_style( 'custom-login-styles' );
}
add_action('login_head', 'custom_login');