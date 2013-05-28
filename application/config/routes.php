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

$route['default_controller']      = "main";
$route['404_override']            = 'errors/err404';

$route['clubs']                   = 'FitparkClubsController/clubs';
$route['clubs/search:any']        = 'FitparkClubsController/search';
$route['clubs/(\w+)']             = 'FitparkClubsController/$1';
$route['clubs/(\w+)/(\w+)']       = 'FitparkClubsController/$1/$2';

$route['club/(:num)']               = 'FitparkClubController/club/$1';
$route['club/(:num)/(:num)']        = 'FitparkClubController/club/$1/$2';
$route['club/getAbonement/(:num)']    = "FitparkClubController/getAbonement/$1";
$route['club/getFeedback/(:num)']     = "FitparkClubController/getFeedback/$1";
$route['club/getQuestion/(:num)']     = "FitparkClubController/getQuestion/$1";
$route['club/getGuest/(:num)']        = 'FitparkClubController/getGuest/$1';
$route['club/addReview/(\d+)']      = 'FitparkClubController/addReview/$1';
$route['club/vote']               = 'FitparkClubController/vote';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
