<?php

/* trainers*/
$router->map('GET', '/master/trainers', 'App\Controllers\NitishController@showTrainers', 'trainers');

/* students*/
$router->map('GET', '/master/students', 'App\Controllers\NitishController@showStudents', 'students');

?>