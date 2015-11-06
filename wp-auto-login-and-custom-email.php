<?php
/**
 * Plugin Name: Seamless HTTP login and custom user notification email
 * Description: Automatically logs user in via the $_SERVER['REMOTE_USER'] environmental variable if it is set to the user's registered email address and overwrites the pluggable 'wp_new_user_notification()' function to allow the sending of a custom email due to user credentials not being necessary.
 * Author: Scott Gustas
 * Version: 0.2
 */

if ( !function_exists('wp_new_user_notification') ) :
/**
 * Pluggable - Email account registration to a newly-registered user
 *
 * @since 2.0.0
 *
 * @param int    $user_id        User ID.
 */
function wp_new_user_notification($user_id){

    $user = get_userdata($user_id);
    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $message .= sprintf(__('%s'), $blogname) . "\r\n";
    $message  = "Your account has been activated! Please log in at the following URL:\r\n\n";
    $message .= site_url() . "\r\n";

    wp_mail($user->user_email, sprintf(__('[%s] Your account has been activated!'), $blogname), $message);

}
endif;

function login_after_setup_theme() {
  // Single Sign On
  if ( !is_user_logged_in() && !empty($_SERVER['REMOTE_USER']) ) {
    $email = $_SERVER['REMOTE_USER'];
    $username = str_replace( '&', '&amp;', stripslashes( $email ) );
    $user = get_user_by( 'email', $username );
    if ( isset( $user, $user->user_login, $user->user_status ) && 0 == (int) $user->user_status )
      $username = $user->user_login;
    if ( !is_wp_error($user) ) {
      wp_set_current_user($user->ID, $user->user_login);
      wp_set_auth_cookie($user->ID);
      do_action('wp_login', $username);
    }
  }
}
add_action('after_setup_theme', 'login_after_setup_theme' );

function custom_login() {
  //If the Google Apps Login is activated, let's hide the login form
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  wp_register_style( 'custom-login-styles', plugins_url('custom-login-styles.css', __FILE__) );
  $requiredplugin = 'google-apps-login/google_apps_login.php';
  if ( is_plugin_active($requiredplugin) )
    wp_enqueue_style( 'custom-login-styles' );
}
add_action('login_head', 'custom_login');