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
use Carbon\Carbon;

class AttendanceController extends BaseController
{
    public function __construct() {
        
    }

    public function markAttendancePage($id) {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role=='admin') {
                Redirect::to('/');
            }
        }

        $batch=Batch::where('id', $id['id'])->first();
        $students=Student::where('batch_id', $id['id'])->get();
        return view('trainer/markattendance', ['batch'=>$batch, 'students'=>$students]);
    }

    public function save() {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role=='admin') {
                Redirect::to('/');
            }
        }

        if(Request::has('post')) {
            $request=Request::get('post');
            $errors=[];
            $date_error=[];
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules=[
                    'batch_id'=>['required'=>true],
                    'date_of_attd'=>['required'=>true],
                ];
                $validate=new ValidateRequest;
                $validate->abide($_POST, $rules);                

                if(count(Attendance::where('date_of_attd', $request->date_of_attd)->get()) != 0) {
                    $date_error['dateError'] = ['Attendance already marked'];
                }

                if($validate->hasError() || !empty($date_error)) {
                    $response=$validate->getErrorMessages();
                    count($date_error) ? $errors=array_merge($response, $date_error) : $errors=$response;
                    $msg="";
                    foreach($errors as $error) {
                        foreach($error as $e) {
                            $msg.=$e."<br/>";
                        }
                    }
                    Session::add('error', $msg);
                    Redirect::to("/batch/".$request->batch_id."/mark/attendance");
                    exit;
                }
                //process form data
                $students=Student::where('batch_id', $request->batch_id)->get();

                foreach($students as $student) {
                    $status='status'.$student['id'];
                    Attendance::create([
                        'batch_id'=>$request->batch_id,
                        'student_id'=>$student['id'],
                        'date_of_attd'=>Carbon::createFromFormat('Y-m-d h-i-s', $request->date_of_attd.'00-00-00'),
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