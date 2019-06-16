<?php

use Philo\Blade\Blade;
use voku\helper\Paginator;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\Session;
use App\Models\User;

function view($path, array $data=[]) {
    
    $view = __DIR__.'/../../resources/views';
    $cache = __DIR__.'/../../bootstrap/cache';
    
    $blade = new Blade($view, $cache);
    
    echo $blade->view()->make($path, $data)->render();
    
}

function make($filename, $data) {
    
    extract($data);
    
    //start output buffer
    ob_start();
    //include template
    include __DIR__.'/../../resources/views/emails/'.$filename.'.php';
    //get content of the file
    $content=ob_get_contents();
    //erase output buffer and end it
    ob_end_clean();
    
    return $content;
}

function slug($value) {
    //remove all charactes not in this list: undercore / letters / numbers / whitespace
    $value=preg_replace('![^'.preg_quote('_').'\pL\pN\s]+!u', '', mb_strtoLower($value));
    //replace underscore with a dash
    $value=preg_replace('!['.preg_quote('-').'\s]+!u', '-', $value);
    
    //remove whitespace
    return (trim($value, '-'));
}

function fetch($table_name, $object) {
    
    $data=Capsule::select("select * from $table_name where deleted_at is null order by created_at desc");
    
    $data=$object->transform($data);
    
    return $data;
}
function fetch2($table_name, $object, $course_id) {
    
    $data=Capsule::select("select * from $table_name where deleted_at is null and course_id=$course_id order by created_at desc");
    
    $data=$object->transform($data);
    
    return $data;
}

function verifiedUser($userid) {
    return (User::where('id', $userid)->first()['verified']==0) ? false : true;
}

function isAuthenticated() {
    if(isset($_COOKIE['SESSION_USER_NAME']) && isset($_COOKIE['SESSION_USER_ID'])) {
        Session::add('SESSION_USER_NAME', $_COOKIE['SESSION_USER_NAME']);
        Session::add('SESSION_USER_ID', $_COOKIE['SESSION_USER_ID']);
    }
    return (Session::has('SESSION_USER_NAME') && Session::has('SESSION_USER_ID')) ? true : false;
}

function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

function user() {
    if(isAuthenticated()) {
        return User::findOrFail(Session::get('SESSION_USER_ID'));
    }
    return false;
}

?>