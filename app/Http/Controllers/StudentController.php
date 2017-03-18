<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/15/2017
 * Time: 10:19 AM
 */

namespace App\Http\Controllers;
use App\Models\Job;
use App\Models\StudentApplyJob;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function getStudentPage($id){
        if(Auth::guest() || Auth::user()->role_id != 3){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }
        $student_info = User::find($id);
        $student_info->university = StudentProfile::where('id',$id)->first();
        $jobs = array();
        $student_apply_jobs = StudentApplyJob::where('stu_id',$id)->get();
        if($student_apply_jobs) {
            foreach ($student_apply_jobs as $student_apply_job){
                $job_id = $student_apply_job->job_id;
                $job = Job::select('id','name')->where('id',$job_id)->first();
                $job->apply_at = $student_apply_job->created_at;
                $result = $student_apply_job->result;
                if($result == 10)
                    $job->result = 'Waiting';
                if($result == 11)
                    $job->result = 'Joining';
                if($result == 12)
                    $job->result = 'Fail';
                array_push($jobs, $job);
            }
            return view('student_page')->with([
                'student_info' => $student_info,
                'jobs' => $jobs
            ]);
        }
        return view('student_page')->with([
            'student_info' => $student_info
        ]);
    }

    public function postUpdateAccountInfoHasPass(Request $request){
        if(Auth::guest() || Auth::user()->role_id != 3){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }
        $this->validate($request,[
            'email' => 'email|required',
            'new_pass' => 'required',
            'confirm_pass' => 'required'
        ]);
        $password = $request['new_pass'];
        $password_confirm = $request['confirm_pass'];
        if($password != $password_confirm) {
            $message_warning = ['message_danger' => 'Password did not match'];
            return redirect()->back()->with($message_warning);
        }
        $user = User::find(Auth::user()->id);
        $user->full_name = $request['full_name'];
        $user->email = $request['email'];
        $user->password = bcrypt($password);
        $user->save();
        return redirect()->back();
    }

    public function postUpdateAccountInfoNoPass(Request $request){
        if(Auth::guest() || Auth::user()->role_id != 3){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }
        $this->validate($request,[
            'email' => 'email|required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->full_name = $request['full_name'];
        $user->email = $request['email'];
        $user->save();

        return $user;
    }

    public function postUpdatePersionalDetails(Request $request){
        if(Auth::guest() || Auth::user()->role_id != 3){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }

        $user = User::find(Auth::user()->id);
        $user->gender = $request['gender'];
        $user->address = $request['address'] != null ? $request['address'] : '';
        $user->skype_id = $request['skype_id'] != null ? $request['skype_id'] : '';
        $user->phone = $request['phone'] != null ? $request['phone'] : '';
        $user->save();

        $student_profile = StudentProfile::find(Auth::user()->id);
        $student_profile->university = $request['university'] != null ? $request['university'] : '';
        $student_profile->major = $request['major'] != null ? $request['major'] : '';
        $student_profile->save();

        return $user;
    }
}
