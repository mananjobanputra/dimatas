<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Settings.
| -------------------------------------------------------------------------
*/
$config['app_id'] 		= '1099934946684039'; 		// Your app id
$config['app_secret'] 	= '1124e03dec949af36f19509cf31dc30d'; 		// Your app secret key
$config['scope'] 		= 'email,user_birthday,user_location'; 	// custom permissions check - http://developers.facebook.com/docs/reference/login/#permissions
$config['redirect_uri'] = base_url().'auth/fb_success'; 		// url to redirect back from facebook. If set to '', site_url('') will be used


