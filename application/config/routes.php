<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login";
$route['404_override'] = 'error_404';
$route['reset/(:any)'] = "forgot/reset/$1";
$route['activate/(:any)'] = "activate/index/$1";

// URI like '/en/about' -> use controller 'about'
$route['^(en|de|fr|nl)/(.+)$'] = "$2";

// '/en', '/de', '/fr' and '/nl' URIs -> use default controller
$route['^(en|de|fr|nl)$'] = $route['default_controller']; 

/*Image timthum's urls*/
$route['image/(:any)/(:any)/(:any)/(:any)/(:any)'] = "getimage/getimg/$1/$2/$3/$4/$5";
$route['image/(:any)/(:any)/(:any)/(:any)'] = "getimage/index/$1/$2/$3/$4";
$route['image/(:any)/(:any)'] = "getimage/index/$1/$2";

$route['search'] = "explore/explore_search_result";

/*Image timthum's urls ends*/

$route['logout'] = "logout";
$route['admin/logout'] = "auth/logout";
$route['resetpassword/(:any)'] = "resetpassword/index/$1";


/*$route['change_password'] = "auth/change_password";*/
$route['profile/(:num)'] = "profile/index/$1";
/*$route['account'] = "auth/edit_profile";*/


$route['social'] 	= 	"social/session/";
$route['social/success'] 	= 	"social/success";
$route['social/error'] 	= 	"social/error";
$route['social/deauthorize_facebook'] 	= 	"social/deauthorize_facebook";
$route['social/(:any)'] 	= 	"social/session/$1";

/*$route['simplyportscan/hosts/add'] = "simplyportscan/add";*/
$route[SIMPLY_PORT_SCAN] = "simplyportscan/index";
$route[SIMPLY_PORT_SCAN.'/hosts/add'] = "simplyportscan/add";
$route[SIMPLY_PORT_SCAN.'/(:any)'] = "simplyportscan/$1";

$route[SIMPLY_MONITOR_SCAN] = "simplymonitor/index";
$route[SIMPLY_MONITOR_SCAN.'/(:any)'] = "simplymonitor/$1";

$route[SIMPLY_VULNERABILITY_SCAN] = "simplyvulnerablility/index";
$route[SIMPLY_VULNERABILITY_SCAN.'/(:any)'] = "simplyvulnerablility/$1";

/*Front url*/

/*Admin url's*/
$route['admin'] = "login/index/admin";
$route['admin/login'] = "login/index/admin";
$route['admin/logout'] = "logout/index/admin";



$route['admin/forgot'] = "auth/admin_forgot_password";
$route['admin/profile'] = "profile/index";
$route['admin/profile/change_password'] = "profile/change_password";
$route['admin/profile/edit'] = "profile/edit";
$route['admin/manage_users/add'] = "admin/manage_users/add_edit_user";
$route['admin/manage_users/edit/(:num)'] = "admin/manage_users/add_edit_user/$1";
$route['admin/:(any)'] = "admin/$1";

/*Admin url's ends*/


$route['temp'] = "temp";
/* End of file routes.php */
/* Location: ./application/config/routes.php */