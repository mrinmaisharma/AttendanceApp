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

class ProfileController extends BaseController
{
    public function __construct() {
        
    }

    public function showTrainerProfile() {
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
        $batches=Batch::all();
        $students=Student::all();
        return view('app/profile', ['batches'=>$batches, 'students'=>$students]);
    }
}

?>