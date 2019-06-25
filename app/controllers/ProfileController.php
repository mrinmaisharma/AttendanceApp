<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;
use App\Models\Batch;
use App\Models\Student;

class ProfileController extends BaseController
{
    public function __construct() {
        
    }
    
   public function showProfile() {
       $batches=Batch::all();
       $students=Student::all();
       return view('app/profile', ['batches'=>$batches, 'students'=>$students]);
   }
}

?>