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
use Carbon\Carbon;

class BatchController extends BaseController
{
    public $table_name="batches";
    public $batches;

    public function __construct() {
        $this->batches=Batch::all();
        $object=new Batch;
        $this->batches=fetch($this->table_name, $object);        
    }

    public function assignTrainer($id) {
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
            
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules=[
                    'trainer_id'=>['required'=>true]
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
                    Redirect::to("/master/batches");
                    exit;
                }
                Batch::where('id', $id)->update(['trainer_id'=>$request->trainer_id]);
                Session::add('success', 'Trainer Assigned');
                Redirect::to('/master/batches');
            }
            throw new \Exception('Token mismatch');
        }
    }

    public function showTrainerBatches() {
        $user=user();
        $trainer_id = Trainer::where('username', $user['username'])->first()['id'];

        $batches=Batch::where('trainer_id', $trainer_id)->get();
        for($i = 0; $i < count($batches); $i++) {
            $batches[$i]['students'] = Student::where('batch_id', $batches[$i]['id'])->get();
            $start = new Carbon($batches[$i]['start_date']);
            $batches[$i]['start_date'] = $start->toFormattedDateString();
            if($batches[$i]['students'] == null) {
                $batches[$i]['students']=array();
            }
        }
        return view('trainer/batches', [ 'batches'=>$batches ]);
    }

    public function showEditBatchPage($id) {
        $batch=Batch::where('id', $id['id'])->first();
        $start=new Carbon($batch['start_date']);
        $batch['start_date']=$start->format("Y-m-d");
        if($batch['end_date'] != null) {
            $end = new Carbon($batch['end_date']);
            $batch['end_date'] = $end->format("Y-m-d");
        }
        return view('app/edit-batch', [ 'batch'=>$batch ]);
    }

    public function showBatches() {
        if(!isAuthenticated()) {
            Redirect::to('/');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role!='admin') {
                Redirect::to('/');
            }
        }

        $batches=$this->batches;
        for($i = 0; $i < count($batches); $i++) {
            $batches[$i]['students'] = Student::where('batch_id', $batches[$i]['id'])->get();
            if($batches[$i]['students'] == null) {
                $batches[$i]['students']=array();
            } 
            $batches[$i]['trainer'] = Trainer::where('id', $batches[$i]['trainer_id'])->first();
        }
        return view('app/batches', [ 'batches'=>$batches ]);
    }
    
    public function create() {
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
                    'start_date'=>Carbon::createFromFormat('Y-m-d h-i-s', $request->start_date.' 00-00-00'),
                    'end_date'=>($request->end_date == '') ? null : Carbon::createFromFormat('Y-m-d h-i-s', $request->end_date.' 00-00-00')
                ]);
                
                
                Session::add('success', 'Batch Created');
                Redirect::to('/');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }

    public function edit($id) {
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
                    'start_date'=>['required'=>true],
                ];
                
                if(Batch::where([['name', $request->name], ['id', "<>", $id['id']]])->first()){
                    $duplicate_error['duplictate']=['This name already exists.'];
                }

                $validate=new ValidateRequest;
                $validate->abide($_POST, $rules);
                if (!strtotime($request->start_date) ) {
                    Session::add('error', 'Invalid Start Date format');
                    Redirect::to('/batch/'.$id['id'].'/edit');
                    exit;
                }
                if ($request->end_date != '' && !strtotime($request->end_date)) {
                    Session::add('error', 'Invalid End Date format');
                    Redirect::to('/batch/'.$id['id'].'/edit');
                    exit;
                }
                if ($request->end_date != '' && (strtotime($request->start_date) > strtotime($request->end_date))) {
                    Session::add('error', 'Start Date cannot be after End Date');
                    Redirect::to('/batch/'.$id['id'].'/edit');
                    exit;
                }

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
                    Redirect::to('/batch/'.$id['id'].'/edit');
                    exit;
                }
                //process form data
                Batch::where('id', $id)->update([
                    'name'=>$request->name,
                    'start_date'=>Carbon::createFromFormat('Y-m-d h-i-s', $request->start_date.' 00-00-00'),
                    'end_date'=>($request->end_date == '') ? null : Carbon::createFromFormat('Y-m-d h-i-s', $request->end_date.' 00-00-00')
                ]);
                
                
                Session::add('success', 'Batch updated');
                Redirect::to('/master/batches');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }

    public function delete($id) {
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
            
            if(CSRFToken::verifyCSRFToken($request->token)) {
                Batch::destroy($id);
                
                $students=Student::where('batch_id', $id['id'])->get();
                if(count($students)) {
                    foreach($students as $student) {
                        $student->delete();
                    }
                }

                Session::add('success', 'Batch Deleted');
                Redirect::to('/master/batches');
            }
            throw new \Exception('Token mismatch');
        }
    }
    
}

?>