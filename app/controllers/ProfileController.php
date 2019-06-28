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
use App\Models\User;
use App\Models\Attendance;

class ProfileController extends BaseController
{
    public function __construct() {
        
    }

    public function showTrainerProfile() {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role=='admin') {
                Redirect::to('/');
            }
        }
        
        $user=user();
        $trainer = Trainer::where('username', $user['username'])->first();

        $batches=Batch::where('trainer_id', $trainer['id'])->get();
        $countOfMyStudents = 0;
        for($i = 0; $i < count($batches); $i++) {
            $batches[$i]['students'] = Student::where('batch_id', $batches[$i]['id'])->get();
            if($batches[$i]['students'] == NULL) {
                $batches[$i]['students']=array();
            } 
            $countOfMyStudents += count($batches[$i]['students']);
        }
        return view('trainer/profile', ['batches'=>$batches, 'countOfStudents'=>$countOfMyStudents, 'trainer'=>$trainer]);
    }

    public function showMasterProfile() {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role!='admin') {
                Redirect::to('/');
            }
        }
        
        $user=user();
        $master = Admin::where('username', $user['username'])->first();

        $batches=Batch::all();
        $students=Student::all();
        return view('app/profile', ['batches'=>$batches, 'countOfStudents'=>count($students), 'master'=>$master]);
    }
    
    public function showEditMasterProfilePage($id) {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role!='admin') {
                Redirect::to('/');
            }
        }
        $master=Admin::where('id', $id['id'])->first();
        
        return view('app/edit-master-profile', [ 'master'=>$master ]);
    }

    public function showEditTrainerProfilePage($id) {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role!='trainer') {
                Redirect::to('/');
            }
        }
        $trainer=Trainer::where('id', $id['id'])->first();
        
        return view('trainer/edit-trainer-profile', [ 'trainer'=>$trainer ]);
    }

    public function editMasterProfile($id) {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role!='admin') {
                Redirect::to('/');
            }
        }

        if(Request::has('post')) {
            $request=Request::get('post');
            $errors=[];
            $duplicate_error=[];
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules=[
                    'name'=>['required'=>true],
                    'username'=>['required'=>true],
                    'phn_number'=>['required'=>true],
                    'email'=>['required'=>true]
                ];
                
                $oldUserName=Admin::where('id', $id)->first()['username'];
                if($oldUserName != $request->username) {
                    if(User::where('username', $request->username)->first()){
                        $duplicate_error['duplictate']=['This username is already taken.'];
                    }
                }

                $validate=new ValidateRequest;
                $validate->abide($_POST, $rules);

                if($validate->hasError() || !empty($duplicate_error)) {
                    $response=$validate->getErrorMessages();
                    count($duplicate_error) ? $errors=array_merge($response, $duplicate_error) : $errors=$response;
                    $msg="";
                    foreach($errors as $error) {
                        foreach($error as $e) {
                            $msg.=$e."<br/>";
                        }
                    }
                    Session::add('error', $msg);
                    Redirect::to('/master/'.$id['id'].'/edit');
                    exit;
                }
                //process form data
                
                if($oldUserName != $request->username){
                    Admin::where('id', $id)->update([
                        'name'=>$request->name,
                        'username'=>$request->username,
                        'phn_number'=>$request->phn_number,
                        'whatsapp_number'=>($request->whatsapp_number == '') ? null : $request->whatsapp_number,
                        'email'=>$request->email,
                        'address'=>($request->address == '') ? null : $request->address,
                        'city'=>($request->city == '') ? null : $request->city,
                        'state'=>($request->state == '') ? null : $request->state,
                        'pincode'=>($request->pincode == '') ? null : $request->pincode
                    ]);

                    User::where('username', $oldUserName)->update([
                        'username'=>$request->username
                    ]);
                }
                else {
                    Admin::where('id', $id)->update([
                        'name'=>$request->name,
                        'phn_number'=>$request->phn_number,
                        'whatsapp_number'=>($request->whatsapp_number == '') ? null : $request->whatsapp_number,
                        'email'=>$request->email,
                        'address'=>($request->address == '') ? null : $request->address,
                        'city'=>($request->city == '') ? null : $request->city,
                        'state'=>($request->state == '') ? null : $request->state,
                        'pincode'=>($request->pincode == '') ? null : $request->pincode
                    ]);
                }
                
                
                Session::add('success', 'Profile updated');
                Redirect::to('/master/profile');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }

    public function EditTrainerProfile($id) {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role!='trainer') {
                Redirect::to('/');
            }
        }

        if(Request::has('post')) {
            $request=Request::get('post');
            $errors=[];
            $duplicate_error=[];
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules=[
                    'name'=>['required'=>true],
                    'username'=>['required'=>true],
                    'phn_number'=>['required'=>true],
                    'email'=>['required'=>true]
                ];
                
                $oldUserName=Trainer::where('id', $id)->first()['username'];
                if($oldUserName != $request->username) {
                    if(User::where('username', $request->username)->first()){
                        $duplicate_error['duplictate']=['This username is already taken.'];
                    }
                }

                $validate=new ValidateRequest;
                $validate->abide($_POST, $rules);

                if($validate->hasError() || !empty($duplicate_error)) {
                    $response=$validate->getErrorMessages();
                    count($duplicate_error) ? $errors=array_merge($response, $duplicate_error) : $errors=$response;
                    $msg="";
                    foreach($errors as $error) {
                        foreach($error as $e) {
                            $msg.=$e."<br/>";
                        }
                    }
                    Session::add('error', $msg);
                    Redirect::to('/trainer/profile/'.$id['id'].'/edit');
                    exit;
                }
                //process form data
                
                if($oldUserName != $request->username){
                    Trainer::where('id', $id)->update([
                        'name'=>$request->name,
                        'username'=>$request->username,
                        'phn_number'=>$request->phn_number,
                        'whatsapp_number'=>($request->whatsapp_number == '') ? null : $request->whatsapp_number,
                        'email'=>$request->email,
                        'address'=>($request->address == '') ? null : $request->address,
                        'city'=>($request->city == '') ? null : $request->city,
                        'state'=>($request->state == '') ? null : $request->state,
                        'pincode'=>($request->pincode == '') ? null : $request->pincode
                    ]);

                    User::where('username', $oldUserName)->update([
                        'username'=>$request->username
                    ]);
                }
                else {
                    Trainer::where('id', $id)->update([
                        'name'=>$request->name,
                        'phn_number'=>$request->phn_number,
                        'whatsapp_number'=>($request->whatsapp_number == '') ? null : $request->whatsapp_number,
                        'email'=>$request->email,
                        'address'=>($request->address == '') ? null : $request->address,
                        'city'=>($request->city == '') ? null : $request->city,
                        'state'=>($request->state == '') ? null : $request->state,
                        'pincode'=>($request->pincode == '') ? null : $request->pincode
                    ]);
                }
                
                
                Session::add('success', 'Trainer updated');
                Redirect::to('/trainer/profile');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }
    
    public function showStudentProfile($id) {
        $user=user();
        $student = Student::where('id', $id['id'])->first();
        $batch_id=$student['batch_id'];

        $total=count(Attendance::where('batch_id', $batch_id)->groupBy('date_of_attd')->get());
        $present=count(Attendance::where([['student_id', $id['id']], ['batch_id', $batch_id], ['status', 'present']])->get());
        $absent=$total-$present;

        if($user['role']=='admin')
            return view('app/student-profile', ['student'=>$student, 'total'=>$total, 'present'=>$present, 'absent'=>$absent]);
        elseif($user['role']=='trainer')
            return view('trainer/student-profile', ['student'=>$student, 'total'=>$total, 'present'=>$present, 'absent'=>$absent]);

    }

    public function changePassword() {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }

        if(Request::has('post')) {
            $request=Request::get('post');
            $errors=[];
            $extra_error=[];
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules=[
                    'username'=>['required'=>true],
                    'oldPassword'=>['required'=>true],
                    'newPassword'=>['required'=>true],
                    'confirmPassword'=>['required'=>true],
                ];
                
                if($request->username != user()['username']) {
                    $extra_error['invalidUser']=['Invalid User'];
                }
                if($request->newPassword != $request->confirmPassword) {
                    $extra_error['confirmPassword']=['Confirm Password do not match'];
                }
                if(!password_verify($request->oldPassword, user()['password'])) {
                    $extra_error['oldPassword']=['Incorrect current password'];
                }

                $validate=new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                if($validate->hasError() || !empty($extra_error)) {
                    $response=$validate->getErrorMessages();
                    count($extra_error) ? $errors=array_merge($response, $extra_error) : $errors=$response;
                    $msg="";
                    foreach($errors as $error) {
                        foreach($error as $e) {
                            $msg.=$e."<br/>";
                        }
                    }
                    Session::add('error', $msg);
                    if(user()['role'] == 'admin')
                        Redirect::to('/master/profile');
                    else if(user()['role'] == 'trainer')
                        Redirect::to('/trainer/profile');
                    exit;
                }
                //process form data
                User::where('username', $request->username)->update([
                    'password'=>password_hash($request->newPassword, PASSWORD_BCRYPT)
                ]); 
                
                
                Session::add('success', 'Password changed Successfully. Please login...');
                Session::remove('SESSION_USER_ID');
                Session::remove('SESSION_USER_NAME');
            
                Redirect::to('/login');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }

}

?>