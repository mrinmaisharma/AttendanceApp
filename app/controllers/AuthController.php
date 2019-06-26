<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;
use App\Models\User;

class AuthController extends BaseController
{
    public function __construct() {
        
    }
    
   public function showLoginForm() {
       return view('auth/login');
   }

    public function login() {
        if(Request::has('post')) {
            $errors=array();
            $request=Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'username' => ['required' => true],
                    'password' => ['required' => true, 'minLength' => 6]
                ];
                
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                if($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
                
                //check if user exists in db
                $user=User::where('username', $request->username)->first();
                
                if($user) {
                    if(!password_verify($request->password, $user->password)) {
                        array_push($errors, 'Incorrect Password');
                        header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                        echo json_encode($errors);
                        exit;
                    }
                    else {
                        Session::add('SESSION_USER_ID', $user->id);
                        Session::add('SESSION_USER_NAME', $user->username);
                        Session::add('SESSION_USER_ROLE', $user->role);
                        echo json_encode(['success'=>'Login Successful. Redirecting...', 'uri'=>$request->uri]);
                        exit;
                    }
                }
                else {
                    array_push($errors, 'User not found, please try again.');
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
            }
            else {
                array_push($errors, 'Session Expired. Please reload the page.');
                header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                echo json_encode($errors);
                exit;
            }
        }
        return null;
    }

    public function logout() {
        if(isAuthenticated()) {
            Session::remove('SESSION_USER_ID');
            Session::remove('SESSION_USER_NAME');
            // setcookie("SESSION_USER_ID", "0", time()-60*60);
            // setcookie("SESSION_USER_NAME", "0", time()-60*60);
            if(!Session::has('user_cart')) {
                session_destroy();
                if(is_session_started()){
					session_regenerate_id(true);
				}
            }
        }
        Redirect::to('/');
    }

}

?>