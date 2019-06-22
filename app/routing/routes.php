<?php

$router = new AltoRouter;

/*dashboard*/
$router->map('GET', '/', 'App\Controllers\IndexController@showDashboard', 'dashboard');

/*profile*/
$router->map('GET', '/profile', 'App\Controllers\ProfileController@showProfile', 'profile');

/*auth*/
$router->map('GET', '/login', 'App\Controllers\AuthController@showLoginForm', 'login');

?>