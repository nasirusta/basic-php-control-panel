<?php
Route::run('front', '/', 'index@index');
Route::run('front', '/about-us', 'sayfa@about_us');
Route::run('front', '/article/{url}', 'sayfa@article');
Route::run('front', '/article/{url}/', 'sayfa@article');
Route::run('front', '/news/{url}', 'sayfa@news');
Route::run('front', '/news/{url}/', 'sayfa@news');
Route::run('front', '/about-us/{url}', 'sayfa@about_us');
Route::run('front', '/login-register', 'sayfa@login_register', 'POST');
Route::run('front', '/register', 'sayfa@register', 'POST');
Route::run('front', '/contact-us', 'sayfa@contact_us', 'GET');
Route::run('front', '/contact-us', 'sayfa@contact_us', 'POST');
Route::run('front', '/contact-us/', 'sayfa@contact_us', 'GET');
Route::run('front', '/contact-us/', 'sayfa@contact_us', 'POST');

$menu["kinnetwork"]			= "GET";
$menu["projects"]			= "GET";
$menu["our-news"]			= "GET";
$menu["login-register"]		= "GET";
$menu["register"]			= "GET";
$menu["faq"]				= "GET";
$menu["projects-guide"]		= "GET";
$menu["user-log-chack"]		= "POST";

foreach($menu as $url => $value){
	$link = str_replace("-", "_", $url);
	Route::run('front', '/'.$url, 'sayfa@'.$link, $value);
	Route::run('front', '/'.$url.'/', 'sayfa@'.$link, $value);
}
