<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;

class NitishController extends BaseController
{
    public function markAttendance(){
        return view('app/mark-attendance');
    }
    
}

?>