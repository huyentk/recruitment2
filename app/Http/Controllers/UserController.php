<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/8/2017
 * Time: 8:55 AM
 */

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function postSignIn(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return redirect()->route('home');
        }
        $message = ['message_danger' => 'Sorry, unrecognised username or password.'];
        return redirect()->route('get-sign-in')->with($message);
    }

    public function postSignUp(Request $request)
    {
        $this->validate( $request, [
            'email' => 'required|email|unique:users',
            'fullname' => 'required|max:120',
            'password' => 'required|min:4',
            'password-confirm' => 'required|min:4'
        ]);
        $email = $request['email'];
        $fullname = $request['fullname'];
        $password = $request['password'];
        $password_confirm = $request['password-confirm'];
        if($password != $password_confirm){
            $message_warning = ['message_warning' => 'Password did not match'];
            return redirect()->back()->with($message_warning);
        }

        //create User
        $user = new User();
        $user->full_name = $fullname;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        //create Student Profile
        $student_profile = new StudentProfile();
        $student_profile->id = $user->id;
        $student_profile->university = '';
        $student_profile->major = '';
        $student_profile->save();

        Auth::login($user);
        return redirect()->route('home');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }
}