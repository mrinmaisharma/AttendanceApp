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
    
    public function showStudentProfile($id) {
        $user=user();
        $student = Student::where('id', $id['id'])->first();
        $batch_id=Attendance::where('student_id', $id['id'])->first()['batch_id'];

        $total=count(Attendance::where('batch_id', $batch_id)->groupBy('date_of_attd')->get());
        $present=count(Attendance::where([['student_id', $id['id']], ['status', 'present']])->get());
        $absent=$total-$present;

        if($user['role']=='admin')
            return view('app/student-profile', ['student'=>$student, 'total'=>$total, 'present'=>$present, 'absent'=>$absent]);
        elseif($user['role']=='trainer')
            return view('trainer/student-profile', ['student'=>$student, 'total'=>$total, 'present'=>$present, 'absent'=>$absent]);

    }

}

?>