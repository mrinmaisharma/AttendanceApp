<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;

class ProfileController extends BaseController
{
    public function __construct() {
        
    }
    
   public function showProfile() {
       return view('app/profile');
   }
}

?>