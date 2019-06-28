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
use App\Models\Admin;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;

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

    public function viewAttendancePage() {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        
        $attendances=array();
        $batch=null;
        $attd=array();
        if(Request::has('get')) {
            $request=Request::get('get');
            if(isset($request->batch_id) && is_numeric($request->batch_id) && isset($request->date_of_attd) && $request->date_of_attd!='') {
                $batch=Batch::where('id', $request->batch_id)->first();
                $attendances=Attendance::where([['batch_id', $request->batch_id], ['date_of_attd', $request->date_of_attd.' 00:00:00']])->with(['batch', 'student'])->get();
            }
            else if(isset($request->batch_id) && is_numeric($request->batch_id) && (!isset($request->date_of_attd) || $request->date_of_attd=='')) {
                $batch=Batch::where('id', $request->batch_id)->first();
                $attendances=Attendance::where('batch_id', $request->batch_id)->with(['batch', 'student'])->get();
            }
            else if((!isset($request->batch_id) || $request->batch_id='') && (isset($request->date_of_attd) && $request->date_of_attd!='')) {
                $attendances = Attendance::where('date_of_attd', $request->date_of_attd.' 00:00:00')->with(['batch', 'student'])->get();
            }
            else {
                $attendances = Attendance::with(['batch', 'student'])->get();
            }
        }
        else {
            $attendances = Attendance::with(['batch', 'student'])->get();
        }
        if(user()['role'] == "admin") {
            $master = Admin::where('username', user()['username'])->first();
            return view('app/attendance', ['attendances'=>$attendances, 'master'=>$master, 'batch'=>$batch, 'request_date'=>(isset($request->date_of_attd) ? $request->date_of_attd : null)]);
        }
        else if(user()['role'] == "trainer") {
            $trainer = Trainer::where('username', user()['username'])->first();
            return view('trainer/attendance', ['attendances'=>$attendances, 'trainer'=>$trainer, 'batch'=>$batch, 'request_date'=>(isset($request->date_of_attd) ? $request->date_of_attd : null)]);
        }
    }

    public function export() {
        if(Request::has('post')) {
            $request=Request::get('post');
            if($request->export==1) {
                $report = Capsule::select("SELECT DATE(a.date_of_attd) AS Date, b.name AS BatchName, s.name AS StudentName, Status 
                FROM attendances a LEFT JOIN batches b 
                ON a.batch_id = b.id
                LEFT JOIN students s
                ON a.student_id = s.id");
                var_dump($report);
                exit;
                $filename = "Attendance_report_till_".date("Y-m-d").".xls";
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"$filename\"");
                $isPrintHeader = false;
                if (! empty($report)) {
                    foreach ($report as $row) {
                        if (! $isPrintHeader) {
                            echo implode("\t", array_keys($row)) . "\n";
                            $isPrintHeader = true;
                        }
                        echo implode("\t", array_values($row)) . "\n";
                    }
                }
                exit();
            }
        }
        
    }

    public function edit($id) {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role!='admin' && $user->role!='trainer') {
                Redirect::to('/');
            }
        }

        if(Request::has('post')) {
            $request=Request::get('post');
            $errors=[];
            $duplicate_error=[];
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules=[
                    'status'=>['required'=>true],
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
                    Redirect::to('/view/attendance');
                    exit;
                }
                //process form data
                Attendance::where('id', $id['id'])->update([
                    'status'=>$request->status
                ]);
                
                
                Session::add('success', 'Attendance Rectified.');
                Redirect::to('/view/attendance');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }
}

?>