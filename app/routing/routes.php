<?php

$router = new AltoRouter;

/*dashboard*/
$router->map('GET', '/', 'App\Controllers\IndexController@showDashboard', 'dashboard');

/*profile*/
$router->map('GET', '/master/profile', 'App\Controllers\ProfileController@showMasterProfile', 'profile');
$router->map('GET', '/trainer/profile', 'App\Controllers\ProfileController@showTrainerProfile', 'trainer_profile');
$router->map('GET', '/student/[i:id]/profile', 'App\Controllers\ProfileController@showStudentProfile', 'student_profile');

/*auth*/
$router->map('GET', '/login', 'App\Controllers\AuthController@showLoginForm', 'login_form');
$router->map('POST', '/login', 'App\Controllers\AuthController@login', 'login');
$router->map('GET', '/logout', 'App\Controllers\AuthController@logout', 'logout');

/*batches*/
$router->map('GET', '/master/batches', 'App\Controllers\BatchController@showBatches', 'batches');
$router->map('GET', '/batches', 'App\Controllers\BatchController@showTrainerBatches', 'trainer_batches');
$router->map('POST', '/batch/[i:id]/assign/trainer', 'App\Controllers\BatchController@assignTrainer', 'assign_trainer');
$router->map('GET', '/batch/[i:id]/edit', 'App\Controllers\BatchController@showEditBatchPage', 'edit_batch_page');
$router->map('POST', '/batch/[i:id]/edit', 'App\Controllers\BatchController@edit', 'edit_batch');

/*trainer*/
$router->map('GET', '/master/trainers', 'App\Controllers\TrainerController@showTrainers', 'trainers');
$router->map('GET', '/master/trainer/add', 'App\Controllers\TrainerController@showAddTrainerPage', 'add_trainer_page');
$router->map('POST', '/master/trainer/add', 'App\Controllers\TrainerController@create', 'add_trainer');
$router->map('GET', '/student/add', 'App\Controllers\TrainerController@showAddStudentPage', 'trainer_add_student_page');
$router->map('POST', '/student/add', 'App\Controllers\TrainerController@addStudent', 'trainer_add_student');

/*student*/
$router->map('GET', '/master/students', 'App\Controllers\StudentController@showStudents', 'students');
$router->map('GET', '/students', 'App\Controllers\TrainerController@showMyStudents', 'my_students');
$router->map('GET', '/batch/[i:id]/students', 'App\Controllers\StudentController@showBatchStudents', 'batch_students');
$router->map('GET', '/master/student/add', 'App\Controllers\StudentController@showAddStudentPage', 'add_student_page');
$router->map('POST', '/master/student/add', 'App\Controllers\StudentController@create', 'add_student');

/*attendance*/
$router->map('GET', '/batch/[i:id]/mark/attendance', 'App\Controllers\AttendanceController@markAttendancePage', 'mark_attendance');
$router->map('POST', '/batch/[i:id]/mark/attendance', 'App\Controllers\AttendanceController@save', 'save_attendance');

/*nitish*/
require_once __DIR__ . '/nitishroutes.php';

/*master*/
require_once __DIR__ . '/master-routes.php';

?>