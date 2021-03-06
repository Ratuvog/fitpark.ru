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

$route['sales']                     = 'Sales/index';
$route['sales/(:num)']              = 'Sales/sale/$1';
$route['about']                     = 'About/index';

$route['manager/club/(:num)/photo/delete_file/(:num)']    = 'Manager/deleteImage/$1/$2';
$route['manager/club/(:num)/photo/upload_file']    = 'Manager/uploadFile/$1';
$route['manager/club/(:num)/photo']    = 'Manager/photo/$1';
$route['manager/club/(:num)/requests'] = 'Manager/requests/$1';
$route['manager/club/(:num)']    = 'Manager/club/$1';
$route['manager/clubs']          = 'Manager/index';
$route['manager']                = 'Manager/index';
$route['manager/login']          = 'Manager/login';
$route['manager/logout']          = 'Manager/logout';
$route['manager/signup']          = 'Manager/signup';
$route['manager/districts']          = 'Manager/districts';
$route['manager/saveCommon']          = 'Manager/saveCommon';
$route['manager/saveServices']          = 'Manager/saveServices';
$route['manager/savePrices']          = 'Manager/savePrices';
$route['manager/saveDescription']          = 'Manager/saveDescription';
$route['manager/logoUpload']          = 'Manager/logoUpload';
$route['manager/signup_submit']          = 'Manager/signup_submit';
$route['manager/signup/success']          = 'Manager/signup/true';

$route['club_selector']             = 'Club_selector/club_selector';
$route['club_selector/getClubsByDistrict'] = 'Club_selector/getClubsByDistrict';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
