<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;

class NItishController extends BaseController
{
    public function showBatches() {
        return view('app/batches');
    }
    public function showTrainers() {
        return view('app/trainers');
    }
    public function showStudents() {
        return view('app/students');
    }
}

?>