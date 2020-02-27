<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['advertiser/payment'] = 'payments/payment';

/*----for tracking--*/
$route['advertiser/(:any)'] = 'page/advertisers/$1';
$route['publisher/(:any)'] = 'page/publishers/$1';
$route['advertisers/(:any)'] = 'page/advertisers/$1';
$route['publishers/(:any)'] = 'page/publishers/$1';
$route['Advertisers/(:any)'] = 'page/advertisers/$1';
$route['Publishers/(:any)'] = 'page/publishers/$1';
/*----for tracking--*/

$route['advertiser'] = 'page/advertisers';
$route['publisher'] = 'page/publishers';
$route['advertisers'] = 'page/advertisers';
$route['publishers'] = 'page/publishers';
$route['Advertisers'] = 'page/advertisers';
$route['Publishers'] = 'page/publishers';
$route['ad_format'] = 'page/ad_format';
$route['p/form'] = 'page/form_intro';
$route['P/FORM'] = 'page/form_intro';
$route['cpa/(:any)'] = 'cpa_form/index/$1';
$route['form/(:any)'] = 'cpa_form/index/$1';
$route['forget_password'] ='page/forget_password';
$route['ch_admin'] = 'page/ch_admin';
$route['How_it_Works'] = 'page/How_it_Works';
$route['Logout'] = 'page/logout';
$route['logout'] = 'page/logout';
$route['media'] = 'media/index';
$route['contact_us'] = 'page/contact_us';
$route['Register'] = 'page/register';
$route['register'] = 'page/register';
$route['next_reg'] = 'page/next_reg';
$route['Login'] = 'page/login';
$route['login'] = 'page/login';
$route['initial'] = 'initial';
$route['blog'] = 'blog/index';
$route['blog/(:any)'] = 'blog/view/$1';
$route['p/(:any)'] = 'page/single_page/$1';
$route['default_controller'] = 'page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
