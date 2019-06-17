<?php

//start session if not already started
if(!isset($_SESSION)) {
    session_start();
}
date_default_timezone_set("Asia/Kolkata");
//load environement variables
require_once __DIR__.'/../app/config/_env.php';

//Instantiate database class
new \App\Classes\Database();


//set custom error handler
set_error_handler([new \App\Classes\ErrorHandler(), 'handleErrors']);


require_once __DIR__.'/../app/routing/routes.php';

new \App\RouteDispatcher($router);



?>