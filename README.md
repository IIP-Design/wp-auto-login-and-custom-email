# wp-auto-login-and-custom-email
A simple WordPress plugin for single sign-on based on the user's email address.

Plugin Name: Seamless HTTP login and custom user notification email

Description: Automatically logs user in via the $_SERVER['REMOTE_USER'] environmental variable if it is set to the user's registered email address and overwrites the pluggable 'wp_new_user_notification()' function to allow the sending of a custom email due to user credentials not being necessary.

Author: Scott Gustas

Current Version: 0.2

##Installation
Download folder as a zip file and upload it via the WordPress plugins dashboard.
