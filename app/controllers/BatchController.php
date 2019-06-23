<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;
use App\Models\Batch;
use Carbon\Carbon;

class BatchController extends BaseController
{
    public function __construct() {
        
    }
    
    public function create() {
        // if(!isAuthenticated()) {
        //     Redirect::to('/');
        // }
        // else if(isAuthenticated()) {
        //     $user=User::where('username', Session::get('SESSION_USER_NAME'))->first();
        //     if($user->role!='admin') {
        //         Redirect::to('/');
        //     }
        // }
        if(Request::has('post')) {
            $request=Request::get('post');
            $errors=[];
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules=[
                    'name'=>['required'=>true, "unique"=>"batches"],
                    'start_date'=>['required'=>true],
                ];
                
                $validate=new ValidateRequest;
                $validate->abide($_POST, $rules);
                if (!strtotime($request->start_date)) {
                    Session::add('error', 'Invalid Start Date format');
                    Redirect::to('/');
                    exit;
                }
                if ($request->end_date != '' && !strtotime($request->end_date)) {
                    Session::add('error', 'Invalid End Date format');
                    Redirect::to('/');
                    exit;
                }
                if ($request->end_date != '' && (strtotime($request->start_date) > strtotime($request->end_date))) {
                    Session::add('error', 'Start Date cannot be after End Date');
                    Redirect::to('/');
                    exit;
                }

                if($validate->hasError()) {
                    $errors=$validate->getErrorMessages();
                    $msg="";
                    foreach($errors as $error) {
                        foreach($error as $e) {
                            $msg.=$e."<br/>";
                        }
                    }
                    Session::add('error', $msg);
                    Redirect::to("/");
                    exit;
                }
                //process form data
                Batch::create([
                    'name'=>$request->name,
                    'start_date'=>Carbon::createFromFormat('Y-m-d h-i-s', $request->start_date.'00-00-00'),
                    'end_date'=>($request->end_date == '') ? null : Carbon::createFromFormat('Y-m-d h-i-s', $request->end_date.'00-00-00')
                ]);
                
                
                Session::add('success', 'Batch Created');
                Redirect::to('/');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }
    
}

?>