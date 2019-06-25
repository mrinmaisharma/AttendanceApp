<?php

$router = new AltoRouter;

/*dashboard*/
$router->map('GET', '/', 'App\Controllers\IndexController@showDashboard', 'dashboard');

/*profile*/
$router->map('GET', '/profile', 'App\Controllers\ProfileController@showProfile', 'profile');

/*auth*/
$router->map('GET', '/login', 'App\Controllers\AuthController@showLoginForm', 'login');

/*batches*/
$router->map('GET', '/master/batches', 'App\Controllers\BatchController@showBatches', 'batches');

/*trainer*/
$router->map('GET', '/master/trainers', 'App\Controllers\TrainerController@showTrainers', 'trainers');
$router->map('GET', '/master/trainer/add', 'App\Controllers\TrainerController@showAddTrainerPage', 'add_trainer_page');
$router->map('POST', '/master/trainer/add', 'App\Controllers\TrainerController@create', 'add_trainer');

/*student*/
$router->map('GET', '/master/students', 'App\Controllers\StudentController@showStudents', 'students');
$router->map('GET', '/master/student/add', 'App\Controllers\StudentController@showAddStudentPage', 'add_student_page');
$router->map('POST', '/master/student/add', 'App\Controllers\StudentController@create', 'add_student');

/*nitish*/
require_once __DIR__ . '/nitishroutes.php';

/*master*/
require_once __DIR__ . '/master-routes.php';

?>