# wp-auto-login-and-custom-email
A simple WordPress plugin for single sign-on based on the user's email address.

Plugin Name: Seamless HTTP login and custom user notification email

Description: Automatically logs user in via the $_SERVER['REMOTE_USER'] environmental variable if it is set to the user's registered email address and overwrites the pluggable 'wp_new_user_notification()' function to allow the sending of a custom email due to user credentials not being necessary.

Author: Scott Gustas

Current Version: 0.2

##Requirements
This plugin was written to compliment the mod_auth_openidc Apache module and the Google Apps Login WordPress plugin. `OIDCRemoteUserClaim email` must be set in the Apache configuration as this plugin will log the user in via email address.

##Installation
Download folder as a zip file and upload it via the WordPress plugins dashboard.
