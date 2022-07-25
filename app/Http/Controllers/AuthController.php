<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\General;
use Illuminate\Http\Request;
use App\Models\Authentication;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;

class AuthController extends BasicController
{
    public function showRegister() {
        $this->data['page'] = [['Home', '/'], ['Register','/register']];
        General::incrementView(4);

        return view('pages.authentication.register', $this->data);
    }
    public function doRegister(Request $request) {
        $validator = Validator::make($request->all(),[
            "register-username" => "required|min:2|max:30|alpha_dash",
            "register-email" => "required|email|max:100",
            "register-password" => "required|min:5",
            "register-confirm-password" => "required|same:register-password"
        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $user = Authentication::checkIfExistsByAttr("username", $request->input('register-username'));
        $mail = Authentication::checkIfExistsByAttr("email", $request->input('register-email'));

        if ($user) {
            $validator->errors()->add('username', 'This username is already in use.');
            return Redirect::back()->withErrors($validator);
        }
        else if ($mail) {
            $validator->errors()->add('email', 'This email is already in use.');
            return Redirect::back()->withErrors($validator);
        }
        else {
            $registerAttempt = Authentication::registerUser($request->input('register-username'), $request->input('register-email'), $request->input('register-password'));

            Session::put('successfullRegistration', "You have successfully registered, please log in.");
            return redirect()->route('login.show');
        }
    }

    public function showLogin() {
        $this->data['page'] = [['Home', '/'], ['Login','/login']];
        General::incrementView(5);

        return view('pages.authentication.login', $this->data);
    }
    public function doLogin(Request $request) {
        $validator = Validator::make($request->all(),[
            "login-email" => "required|email|max:100",
            "login-password" => "required|min:5",
        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $emailExistance = Authentication::checkIfExistsByAttr("email", $request->input('login-email'));

        if ($emailExistance) {
            $loginAttempt = Authentication::loginAttempt($request->input('login-email'), $request->input('login-password'));

            if ($loginAttempt) {
                Session::put('user', $loginAttempt);
                return redirect()->route('profile');
            }
            else {
                $validator->errors()->add('password', 'Wrong password.');
                return Redirect::back()->withErrors($validator);
            }
        }
        else {
            $validator->errors()->add('email', 'This email does not exist.');
            return Redirect::back()->withErrors($validator);
        }
    }
    public function showProfile() {
        if (Session::get('user')) {
            $this->data['user'] = Session::get('user');
        }

        $this->data['page'] = [['Home', '/'], [$this->data['user']->username, '/profile']];
        return view('pages.profile.show', $this->data);
    }

    public function logoff() {
        Session::forget('user');
        return redirect()->route('login.show');
    }
}
