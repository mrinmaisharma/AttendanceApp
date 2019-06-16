<?php

$router = new AltoRouter;

/*home*/
$router->map('GET', '/', 'App\Controllers\IndexController@show', 'home');
$router->map('GET', '/featured', 'App\Controllers\IndexController@featuredCourses', 'featured_course');
$router->map('GET', '/get-courses', 'App\Controllers\IndexController@getCourses', 'get-courses');
$router->map('POST', '/load-more', 'App\Controllers\IndexController@loadMoreCourses', 'load-more-courses');
$router->map('GET', '/courses', 'App\Controllers\CourseController@showAllCourses', 'show-all-courses');

/*course*/
$router->map('GET', '/course/[i:id]', 'App\Controllers\CourseController@show', 'course');
$router->map('GET', '/course/[i:id]/curriculum', 'App\Controllers\admin\CourseTopicController@getCurriculum', 'get_curriculum');
$router->map('GET', '/course/[i:id]/batches', 'App\Controllers\admin\BatchController@getBatches', 'get_upcoming_batches');

/*authentication*/
$router->map('GET', '/login', 'App\Controllers\AuthController@showLoginForm', 'login_form');
$router->map('POST', '/login', 'App\Controllers\AuthController@login', 'login');
$router->map('POST', '/signup', 'App\Controllers\AuthController@register', 'register');
$router->map('GET', '/verify/email', 'App\Controllers\AuthController@showVerifyForm', 'show_verify_form');
$router->map('POST', '/verify/email', 'App\Controllers\AuthController@verify', 'verify_email');
$router->map('POST', '/resend/otp', 'App\Controllers\AuthController@resendOtp', 'resendOtp');
$router->map('GET', '/logout', 'App\Controllers\AuthController@logout', 'logout');

/*forgot password*/
$router->map('POST', '/forgotpassword', 'App\Controllers\AuthController@forgotPwd', 'forgotPwd');
$router->map('GET', '/forgotpassword/reset', 'App\Controllers\AuthController@resetPwdForm', 'reset_password_form');
$router->map('POST', '/forgotpassword/reset', 'App\Controllers\AuthController@forgotPwdReset', 'reset_password');

/*testimony*/
$router->map('GET', '/testimonial/write', 'App\Controllers\TestimonyController@showTestimonyForm', 'show_testimony_from');
$router->map('POST', '/testimonial/write', 'App\Controllers\TestimonyController@saveTestimony', 'save_testimony');

/*contact*/
$router->map('GET', '/contact', 'App\Controllers\ContactController@showContactPage', 'show_contact_page');
$router->map('POST', '/contact', 'App\Controllers\ContactController@sendMail', 'send_mail');

//admin_routes
require_once __DIR__ . '/admin_routes.php';

?>