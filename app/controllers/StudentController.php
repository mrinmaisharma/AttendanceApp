<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;
use App\Models\Student;
use App\Models\Batch;
use App\Models\User;

class StudentController extends BaseController
{
    public $table_name="students";
    public $students;

    public function __construct() {
        $this->students=Student::all();
        $object=new Student;
        $this->students=fetch($this->table_name, $object);        
    }
    
    public function showStudents() {
        $students=$this->students;
        for($i = 0; $i < count($students); $i++) {
            $students[$i]['batch'] = Batch::where('id', $students[$i]['batch_id'])->first();
        }
        return view('app/students', ['students'=>$students]);
    }

    public function showBatchStudents($id) {
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
        
        return view('trainer/batch-students', ['students'=>$students, 'batch'=>$batch]);
    }
    
    public function showAddStudentPage() {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role!='admin') {
                Redirect::to('/');
            }
        }
        
        $batch=null;
        if(Request::has('get')) {
            $request=Request::get('get');
            if(isset($request->batch_id) && is_numeric($request->batch_id)) {
                $batch=Batch::where('id', $request->batch_id)->first();
            }
        }
        return view('app/add-student', ['batch'=>$batch]);
    }

    public function create() {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=User::where('username', Session::get('SESSION_USER_NAME'))->first();
            if($user->role!='admin') {
                Redirect::to('/');
            }
        }
        
        if(Request::has('post')) {
            $request=Request::get('post');
            $errors=[];
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules=[
                    'name'=>['required'=>true],
                    'username'=>['required'=>true, "unique"=>"trainers"],
                    'phn_number'=>['required'=>true],
                    'email'=>['required'=>true],
                    'batch_id'=>['required'=>true],
                    'institute'=>['required'=>true],
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
                    Redirect::to("/master/student/add");
                    exit;
                }
                //process form data
                Student::create([
                    'name'=>$request->name,
                    'username'=>$request->username,
                    'phn_number'=>$request->phn_number,
                    'whatsapp_number'=>($request->whatsapp_number == '') ? null : $request->whatsapp_number,
                    'email'=>$request->email,
                    'batch_id'=>$request->batch_id,
                    'institute'=>$request->institute,
                    'address'=>($request->address == '') ? null : $request->address,
                    'city'=>($request->city == '') ? null : $request->city,
                    'state'=>($request->state == '') ? null : $request->state,
                    'pincode'=>($request->pincode == '') ? null : $request->pincode
                ]);
                
                
                Session::add('success', 'Student Added');
                Redirect::to('/master/students');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }
}

?>