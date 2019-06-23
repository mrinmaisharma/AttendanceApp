<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;

class AuthController extends BaseController
{
    public function __construct() {
        
    }
    
   public function showLoginForm() {
       return view('auth/login');
   }
}

?>