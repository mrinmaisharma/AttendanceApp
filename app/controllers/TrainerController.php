<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;
use App\Models\Trainer;
use App\Models\Batch;

class TrainerController extends BaseController
{
    public $table_name="trainers";
    public $trainers;

    public function __construct() {
        $this->trainers=Trainer::all();
        $object=new Trainer;
        $this->trainers=fetch($this->table_name, $object);        
    }
    
    public function showTrainers() {
        $trainers=$this->trainers;
        for($i = 0; $i < count($trainers); $i++) {
            $trainers[$i]['batch'] = Batch::where('trainer_id', $trainers[$i]['id'])->get();
        }
        return view('app/trainers', ['trainers'=>$trainers]);
    }

    public function showAddTrainerPage() {
        return view('app/add-trainer');
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
                    'name'=>['required'=>true],
                    'username'=>['required'=>true, "unique"=>"trainers"],
                    'phn_number'=>['required'=>true],
                    'email'=>['required'=>true],
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
                    Redirect::to("/master/trainer/add");
                    exit;
                }
                //process form data
                Trainer::create([
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
                
                
                Session::add('success', 'Trainer Added');
                Redirect::to('/master/trainers');
                exit;
            }
            throw new \Exception('Token mismatch');
        }
    }
}

?>