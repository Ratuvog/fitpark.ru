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
$route['404_override']            = '';

$route['question']                      = 'FAQ/getQuestion';
$route["question/(:num)"]               = 'FAQ/getQuestion/$1';
$route["question/addQuestion"]          = 'FAQ/addQuestion';

$route['clubs']                   = 'Clubs/clubs';
$route['clubs/search:any']        = 'Clubs/search';
$route['clubs/(\w+)']             = 'Clubs/$1';
$route['clubs/(\w+)/(\w+)']       = 'Clubs/$1/$2';

$route['club/(:num)']               = 'Club/club/$1';
$route['club/(:num)/(:any)']        = 'Club/club/$1/$2';
$route['club/getAbonement/(:num)']  = "Club/getAbonement/$1";
$route['club/getFeedback/(:num)']   = "Club/getFeedback/$1";
$route['club/getQuestion/(:num)']   = "Club/getQuestion/$1";
$route['club/getGuest/(:num)']      = 'Club/getGuest/$1';
$route['club/addReview/(\d+)']      = 'Club/addReview/$1';
$route['club/vote']                 = 'Club/vote';

$route['training_program']          = 'Training_program/index';
$route['training_program/add']      = 'Training_program/addProgram';
$route['training_program/payment']      = 'Training_program/paymentProgram';
$route['training_program/success_payment'] = 'Training_program/success_payment';
$route['training_program/fail_payment'] = 'Training_program/fail_payment';
$route['payment']                   = 'Payment/index';

$route['exercises']                 = 'Exercises/exercises';
$route['exercises/(:num)']          = 'Exercises/exercises/$1';
$route['exercise/(:num)']           = 'Exercise/index/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
