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

class IndexController extends BaseController
{
    public function __construct() {
        
    }
    
    public function showDashboard() {
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
            return view('app/dashboard', ['quote'=>$quote, 'author'=>$author]);
        }
        else {
            $modified = new Carbon($q->updated_at);
            $modifiedDate = $modified->format('Y m d');
            if($modifiedDate == date("Y m d")) {
                return view('app/dashboard', ['quote'=>$q['quote'], 'author'=>$q['author']]);
            }
            else {
                $response = \Unirest\Request::get("http://quotes.rest/qod.json?category=inspire");
                $quote = $response->body->contents->quotes[0]->quote;
                $author = $response->body->contents->quotes[0]->author;
                Quote::where('type', 'qod')->update([
                    "quote"=>$quote,
                    "author"=>$author
                ]);
                return view('app/dashboard', ['quote'=>$quote, 'author'=>$author]);
            }
        }
    }
}

?>