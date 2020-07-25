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



$route['default_controller'] = 'gigs';
// $route['default_controller'] = 'gigs';
// $route['default_controller'] = 'gigs';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['logout'] = 'admin/auth/logout';


$route['admin'] = 'admin/dashboard';

$route['dashboard'] = 'admin/dashboard';

$route['categories'] = 'admin/categories';

$route['add-categories'] = 'admin/categories/category_add';

$route['add-sub-categories'] = 'admin/categories/sub_category_add';

$route['sub-categories/(:any)'] = 'admin/categories/sub_category/$1';

$route['edit-category/(:any)'] = 'admin/categories/edit_category/$1';

$route['edit-sub-category/(:any)'] = 'admin/categories/edit_sub_category/$1';

$route['user'] = 'admin/user';

$route['edit-user/(:any)'] = 'admin/user/edit_user/$1';

$route['manage-brand'] = 'admin/brand';

$route['add-brand'] = 'admin/brand/add_brand';

$route['edit-brand/(:any)'] = 'admin/brand/edit_brand/$1';

$route['reviews'] = 'admin/reviews';

$route['page'] = 'admin/page';

$route['chat'] = 'admin/chat';
$route['cities'] = 'admin/cities';
$route['add-city'] = 'admin/cities/add_city';
$route['edit-city/(:any)'] = 'admin/cities/edit_city/$1';
$route['terms'] = 'admin/terms';
$route['add-term'] = 'admin/terms/add_term';
$route['edit-term/(:any)'] = 'admin/terms/edit_term/$1';

$route['all-ads-list'] = 'admin/ads';
$route['active-ads'] = 'admin/ads/active_ads';
$route['features-ads'] = 'admin/ads/features_ads';
$route['pending-ads'] = 'admin/ads/pending_ads';
$route['hidden-ads'] = 'admin/ads/hidden_ads';
$route['resubmitted-ads'] = 'admin/ads/resubmitted_ads';
$route['expire-ads'] = 'admin/ads/expire_ads';

$route['edit-ads/(:any)'] = 'admin/ads/edit_ads/$1';

$route['reported-ads'] = 'admin/ads/reported_ads';
$route['setting'] = 'admin/setting';

$route['banner'] = 'admin/banner';
$route['add-banner'] = 'admin/banner/add_banner';
$route['edit-banner/(:any)'] = 'admin/banner/edit_banner/(:any)';
$route['information'] = 'admin/information';
$route['change-password'] = 'admin/setting/change_password';


$route['privacy-policy'] = 'admin/page/privacy_policy';
$route['contact'] = 'admin/page/contact';







