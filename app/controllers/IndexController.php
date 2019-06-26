<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;
use App\Models\Quote;
use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Trainer;

class IndexController extends BaseController
{
    public function __construct() {
        
    }

    public function showTrainerDashboard() {
        $user=user();
        $trainer_id = Trainer::where('username', $user['username'])->first()['id'];

        $batches=Batch::where('trainer_id', $trainer_id)->get();
        $countOfMyStudents = 0;
        for($i = 0; $i < count($batches); $i++) {
            $batches[$i]['students'] = Student::where('batch_id', $batches[$i]['id'])->get();
            if($batches[$i]['students'] == NULL) {
                $batches[$i]['students']=array();
            } 
            $countOfMyStudents += count($batches[$i]['students']);
        }
        $activeBatches = array();
        foreach($batches as $batch) {
            if($batch['end_date'] == NULL) {
                array_push($activeBatches,$batch);
            }
        }

        $q=Quote::where('type', 'qod')->first();
        if(!$q) {
            $response = \Unirest\Request::get("http://quotes.rest/qod.json?category=inspire");
            $quote = $response->body->contents->quotes[0]->quote;
            $author = $response->body->contents->quotes[0]->author;
            Quote::create([
                "type"=>"qod",
                "quote"=>$quote,
                "author"=>$author
            ]);
            return view('trainer/dashboard', [
                'quote'=>$quote, 
                'author'=>$author, 
                'batches'=>$batches, 
                'activeBatches'=>$activeBatches,
                'studentCount'=>$countOfMyStudents
                ]);
        }
        else {
            $modified = new Carbon($q->updated_at);
            $modifiedDate = $modified->format('Y m d');
            if($modifiedDate == date("Y m d")) {
                return view('trainer/dashboard', [
                    'quote'=>$q['quote'], 
                    'author'=>$q['author'], 
                    'batches'=>$batches, 
                    'activeBatches'=>$activeBatches,
                    'studentCount'=>$countOfMyStudents
                    ]);
            }
            else {
                $response = \Unirest\Request::get("http://quotes.rest/qod.json?category=inspire");
                $quote = $response->body->contents->quotes[0]->quote;
                $author = $response->body->contents->quotes[0]->author;
                Quote::where('type', 'qod')->update([
                    "quote"=>$quote,
                    "author"=>$author
                ]);
                return view('trainer/dashboard', [
                    'quote'=>$quote, 
                    'author'=>$author, 
                    'batches'=>$batches, 
                    'activeBatches'=>$activeBatches,
                    'studentCount'=>$countOfMyStudents
                    ]);
            }
        }
    }
    
    public function showDashboard() {
        if(!isAuthenticated()) {
            Redirect::to('/login');
        }
        else if(isAuthenticated()) {
            $user=user();
            if($user->role!='admin') {
                $this->showTrainerDashboard();
                exit;
            }
        }
        $trainers=fetch('trainers', new Trainer);

        $batches=fetch('batches', new Batch);
        for($i = 0; $i < count($batches); $i++) {
            $batches[$i]['students'] = Student::where('batch_id', $batches[$i]['id'])->get();
            if($batches[$i]['students'] == NULL) {
                $batches[$i]['students']=array();
            } 
        }
        $activeBatches = array();
        foreach($batches as $batch) {
            if($batch['end_date'] == NULL) {
                array_push($activeBatches,$batch);
            }
        }
        $q=Quote::where('type', 'qod')->first();
        if(!$q) {
            $response = \Unirest\Request::get("http://quotes.rest/qod.json?category=inspire");
            $quote = $response->body->contents->quotes[0]->quote;
            $author = $response->body->contents->quotes[0]->author;
            Quote::create([
                "type"=>"qod",
                "quote"=>$quote,
                "author"=>$author
            ]);
            return view('app/dashboard', [
                'quote'=>$quote, 
                'author'=>$author, 
                'batches'=>$batches, 
                'activeBatches'=>$activeBatches,
                'trainers'=>$trainers
                ]);
        }
        else {
            $modified = new Carbon($q->updated_at);
            $modifiedDate = $modified->format('Y m d');
            if($modifiedDate == date("Y m d")) {
                return view('app/dashboard', [
                    'quote'=>$q['quote'], 
                    'author'=>$q['author'], 
                    'batches'=>$batches, 
                    'activeBatches'=>$activeBatches,
                    'trainers'=>$trainers
                    ]);
            }
            else {
                $response = \Unirest\Request::get("http://quotes.rest/qod.json?category=inspire");
                $quote = $response->body->contents->quotes[0]->quote;
                $author = $response->body->contents->quotes[0]->author;
                Quote::where('type', 'qod')->update([
                    "quote"=>$quote,
                    "author"=>$author
                ]);
                return view('app/dashboard', [
                    'quote'=>$quote, 
                    'author'=>$author, 
                    'batches'=>$batches, 
                    'activeBatches'=>$activeBatches,
                    'trainers'=>$trainers
                    ]);
            }
        }
    }
}

?>