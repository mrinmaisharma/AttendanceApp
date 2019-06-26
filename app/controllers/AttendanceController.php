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
use App\Models\Trainer;
use App\Models\Attendance;

class ProfileController extends BaseController
{
    public function __construct() {
        
    }

    public function markAttendancePage($id) {
        $batch=Batch::where('id', $id['id'])->first();
        $students=Student::where('batch_id', $id['id'])->get();
        return view('trainer/markattendance', ['batch'=>$batch, 'students'=>$students]);
    }

    public function save() {
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
                    'batch_id'=>['required'=>true],
                    'date_of_attd'=>['required'=>true],
                ];
                
                $validate=new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                if($validate->hasError()) {
                    $errors=$validate->getErrorMessages();
                    $msg="";
                    foreach($errors as $error) {
                        foreach($error as $e) {
                            $msg.=$e."<br/>";
                        }
                    }
                    Session::add('error', $msg);
                    Redirect::to("/batches");
                    exit;
                }
                //process form data
                $students=Student::where('batch_id', $request->batch_id)->get();
                foreach($students as $student) {
                    $sid='std'.$student['id'];
                    $status='status'.$student['id'];
                    Attendance::create([
                        'batch_id'=>$request->batch_id,
                        'student_id'=>$request->$sid,
                        'dateof_attd'=>Carbon::createFromFormat('Y-m-d h-i-s', $request->dat_of_attd.'00-00-00'),
                        'status'=>$request->$status
                    ]);
                }
                                
                
                Session::add('success', 'Attendance Saved');
                Redirect::to('/batches');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }

}

?>