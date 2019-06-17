<?php

$router = new AltoRouter;

/*home*/
$router->map('GET', '/', 'App\Controllers\IndexController@showDashboard', 'dashboard');


?>