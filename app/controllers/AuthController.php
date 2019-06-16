<?php

namespace App\Controllers;

use App\Models\User;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\Mail;

class AuthController extends BaseController
{
    public function __construct() {
        
    }
    
//    public function showRegisterForm() {
//        return view('register');
//    }
//    
    public function showLoginForm() {
        if(isAuthenticated()) {
            Redirect::to('/');
        }
        else {
            return view('home/login');
        }
    }
    
    public function register() {
        if(Request::has('post')) {
            $request=Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'username' => ['required' => true, 'maxLength' => 20, 'string' => true, 'unique' => 'users'],
                    'fullname' => ['required' => true, 'minLength'=>3],
                    'email' => ['required' => true, 'email' => true, 'unique' => 'users'],
                    'password' => ['required' => true, 'minLength' => 6],
                    'c_password' => ['required' => true, 'minLength' => 6],
                ];
                
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                if($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
                
                //insert into database
                User::create([
                    'username' => $request->username,
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'password' => password_hash($request->password, PASSWORD_BCRYPT),
                    'role' => 'user',
                ]);
                $otp=mt_rand(100000, 999999);
                Session::add('EMAIL_VERIFY_OTP', $otp);
                Session::add('VERIFICATION_EMAIL', $request->email);
                
                $data=[
                    'to'=>$request->email,
                    'subject'=>'Verify Email',
                    'view'=>'otp',
                    'name'=>'no-reply@arbre.in',
                    'body'=>[
                                "name"=>$request->fullname,
                                "otp"=>$otp
                            ]
                ];
                $mail=new Mail;
                $mail->send($data);
                
                echo json_encode(['success' => 'Account created, redirecting...', 'uri'=>"/verify/email?uri=$request->uri&username=$request->username&email=$request->email"]);
                exit;
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
    
    public function login() {
        if(Request::has('post')) {
            $errors=array();
            $request=Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'username' => ['required' => true],
                    'password' => ['required' => true],
                    'remember' => ['required' => true]
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
                $user=User::where('username', $request->username)->orWhere('email', $request->username)->first();
                
                if($user) {
                    if(!password_verify($request->password, $user->password)) {
                        array_push($errors, 'Incorrect Password');
                        header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                        echo json_encode($errors);
                        exit;
                    }
                    else {
                        if(!verifiedUser($user->id)) {
                            $otp=mt_rand(100000, 999999);
                            Session::add('EMAIL_VERIFY_OTP', $otp);
                            Session::add('VERIFICATION_EMAIL', $user->email);
                            $data=[
                                'to'=>$user->email,
                                'subject'=>'Verify Email',
                                'view'=>'otp',
                                'name'=>'no-reply@arbre.in',
                                'body'=>[
                                            "name"=>$user->fullname,
                                            "otp"=>$otp
                                        ]
                            ];
                            $mail=new Mail;
                            $mail->send($data);
                            
                            echo json_encode(['success'=>'Login Successful. Redirecting...', 'uri'=>"/verify/email?uri=$request->uri&username=$user->username&email=$user->email"]);
                            exit;
                        }
                        if($request->remember==1) {
                            setcookie("SESSION_USER_ID", $user->id, (time()+30*24*60*60));
                            setcookie("SESSION_USER_NAME", $user->username, (time()+30*24*60*60));
                        }
                        Session::add('SESSION_USER_ID', $user->id);
                        Session::add('SESSION_USER_NAME', $user->username);
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
    
    public function showVerifyForm() {
        if(Request::has('get')) {
            $request=Request::get('get');
            $user=User::where('username', $request->username)->first();
            if(verifiedUser($user->id)) {
                Redirect::to('/');
            }
            return view('home/verify', [
                'uri'=>$request->uri,
                'username'=>$request->username,
                'useremail'=>$request->email,
            ]);
            exit;
        }
        else {
            Redirect::to('/');
        }
        return null;
    }
    
    public function resetPwdForm() {
        if(Request::has('get')) {
            $request=Request::get('get');
            if($request->u==Session::get('PWD_RESET_U_NAME')) {
                $user=User::where('username', $request->u)->first();
                return view('home/resetpassword', ['username'=>$user->username, 'useremail'=>$user->email]);
                exit;
            }
            return view('errors/sessionExpired');
        }
        exit;
    }
    
    public function forgotPwdReset() {
        if(Request::has('post')) {
            $request=Request::get('post');
            $errors=array();
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules = [
                    'username' => ['required' => true],
                    'pwd' => ['required' => true],
                ];
                
                $validate=new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                if($validate->hasError()) {
                    $errors=$validate->getErrorMessages();
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
                if(Session::has('PWD_RESET_U_NAME') && $request->username==Session::get('PWD_RESET_U_NAME')) {
                    $user=User::where('username', $request->username)->update(['password'=>password_hash($request->pwd, PASSWORD_BCRYPT)]);
                    Session::add('success', 'Your password was reset Successfully. PLease Login.');
                    Session::remove('PWD_RESET_U_NAME');
                    echo json_encode(['success' => 'Password reset successfully. Redirecting...', 'uri'=>'/login']);
                    exit;
                }
                else {
                    alert("Session Expired.");
                    echo json_encode(['success' => 'Redirecting...', 'uri'=>'/login']);
                    exit;
                }
                
            }
            throw \Exception('Token Mismatch');
        }
        return null;
    }
    
    public function verify() {
        if(Request::has('post')) {
            $errors=array();
            $request=Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)) {
                $rules = [
                    'otp' => ['required' => true, 'number' => true],
                    'username' => ['required' => true],
                    'useremail' => ['required' => true, 'email' => true],
                    'uri' => ['required' => true],
                ];
                
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                if($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    $msg="";
                    foreach($errors as $error) {
                        $msg.=$error."<br/>";
                    }
                    Session::add('error', $msg);
                    Redirect::to("/verify/email?uri=$request->uri&username=$request->username&email=$request->useremail");
                    exit;
                }
                if(Session::has('EMAIL_VERIFY_OTP') && Session::has('VERIFICATION_EMAIL')) {
                    if(Session::get('EMAIL_VERIFY_OTP')!=$request->otp) {
                        Session::add('error', 'Invalid OTP');
                        Redirect::to("/verify/email?uri=$request->uri&username=$request->username&email=$request->useremail");
                        exit;
                    }
                    else {
                        //update database
                        User::where('email', Session::get('VERIFICATION_EMAIL'))->update(['verified' => 1]);
                        $user=User::where('username', $request->username)->first();
                        Session::add('SESSION_USER_ID', $user->id);
                        Session::add('SESSION_USER_NAME', $user->username);
                        Session::remove('EMAIL_VERIFY_OTP');
                        Session::remove('VERIFICATION_EMAIL');
                        Redirect::to("$request->uri");
                        exit;
                    }
                }
                Redirect::to('/');
                exit;
            }
            throw new \Exception('Token Mismatch');
        }
        return null;
    }
    
    public function resendOtp() {
        if(Request::has('post')) {
            $errors=array();
            $request=Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'username' => ['required' => true],
                ];
                
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                if($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
                if(Session::has('EMAIL_VERIFY_OTP') && Session::has('VERIFICATION_EMAIL')) {
                    $user=User::where('email', Session::get('VERIFICATION_EMAIL'))->first();
                    $otp=Session::get('EMAIL_VERIFY_OTP');

                    $data=[
                        'to'=>$user->email,
                        'subject'=>'Verify Email',
                        'view'=>'otp',
                        'name'=>'no-reply@arbre.in',
                        'body'=>[
                                    "name"=>$user->fullname,
                                    "otp"=>$otp
                                ]
                    ];
                    $mail=new Mail;
                    $mail->send($data);

                    echo json_encode(['success' => 'PLease check your inbox.']);
                    exit;
                }
                else {
                    $user=User::where('username', $request->username)->first();
                    $otp=mt_rand(100000, 999999);
                    Session::add('EMAIL_VERIFY_OTP', $otp);
                    Session::add('VERIFICATION_EMAIL', $user->email);

                    $data=[
                        'to'=>$user->email,
                        'subject'=>'Verify Email',
                        'view'=>'otp',
                        'name'=>'no-reply@arbre.in',
                        'body'=>[
                                    "name"=>$user->fullname,
                                    "otp"=>$otp
                                ]
                    ];
                    $mail=new Mail;
                    $mail->send($data);

                    echo json_encode(['success' => 'PLease check your inbox.']);
                    exit;
                }
            }
            throw new \Exception('Token Mismatch');
        }
        return null;
    }
    
    public function logout() {
        if(isAuthenticated()) {
            Session::remove('SESSION_USER_ID');
            Session::remove('SESSION_USER_NAME');
            setcookie("SESSION_USER_ID", "0", time()-60*60);
            setcookie("SESSION_USER_NAME", "0", time()-60*60);
            if(!Session::has('user_cart')) {
                session_destroy();
                if(is_session_started()){
					session_regenerate_id(true);
				}
            }
        }
        Redirect::to('/');
    }
    
    public function forgotPwd() {
        if(Request::has('post')) {
            $errors=array();
            $request=Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'username' => ['required' => true],
                ];
                
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                if($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
                $user=User::where('username', $request->username)->orWhere('email', $request->username)->first();
                if(!$user) {
                    array_push($errors, 'User not found, please try again.');
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
                else {
                    $user=User::where('username', $request->username)->orWhere('email', $request->username)->first();
                    $appUrl=getenv('APP_URL');
                    Session::add('PWD_RESET_U_NAME', $user->username);
                    $data=[
                        'to'=>$user->email,
                        'subject'=>'Reset Password',
                        'view'=>'resetPwdLink',
                        'name'=>'support@consoleflare.com',
                        'body'=>[
                                    "name"=>$user->fullname,
                                    'url'=>"$appUrl/forgotpassword/reset?u=$user->username&token=$request->token"
                                ]
                    ];
                    $mail=new Mail;
                    $mail->send($data);

                    echo json_encode(['success' => 'Success! PLease check your inbox.']);
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
    
}

?>