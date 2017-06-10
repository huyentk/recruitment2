<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/15/2017
 * Time: 10:19 AM
 */

namespace App\Http\Controllers;
use App\Mail\SendMailRegister;
use App\Models\Job;
use App\Models\StudentApplyJob;
use App\Models\StudentProfile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function getStudentPage($id){
        $student_info = User::find($id);
        $student_info->university = StudentProfile::where('id',$id)->first();
        $student_info->image = file_exists(public_path().'/storage/avatars/'.Auth::user()->id.'.png') ? Storage::url('/avatars/'.Auth::user()->id.'.png') : Storage::url('/avatars/user.png');

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
                    $job->result = 'Fail';
                if($result == 12)
                    $job->result = 'Joining';
                array_push($jobs, $job);
            }
            return view('student.student_page')->with([
                'student_info' => $student_info,
                'jobs' => $jobs
            ]);
        }
        return view('student.student_page')->with([
            'student_info' => $student_info
        ]);
    }

    public function postUpdateAccountInfoHasPass(Request $request){
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
        $this->validate($request,[
            'email' => 'email|required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->full_name = $request['full_name'];
        $user->email = $request['email'];
        $user->save();

        return $user;
    }

    public function postUpdatePersonalDetails(Request $request){
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

    public function postSaveFile(Request $request){
        if($request->hasFile('gpa') && $request->hasFile('cv')) {
            $validator = Validator::make($request->all(), [
                'gpa' => 'required|mimes:pdf',
                'cv' => 'required|mimes:pdf'
            ]);
            if ($validator->failed())
                return redirect()->back()->with(['message_danger' => 'File is not pdf formant.']);
            $gpa = $request->file('gpa');
            Storage::put('/public/GPA/' . Auth::user()->id . '-' . $request['job_id'] . '.pdf', file_get_contents($gpa->getRealPath()));
            $cv = $request->file('cv');
            Storage::put('/public/CV/' . Auth::user()->id . '-' . $request['job_id'] . '.pdf', file_get_contents($gpa->getRealPath()));
            return 1000;
        }
        return -1000;
    }

    public function postRegisterJob(Request $request){
        $gpa = storage_path().'/app/public/GPA/'.Auth::user()->id . '-' . $request['job_id'] . '.pdf' ;
        $cv = storage_path().'/app/public/CV/'.Auth::user()->id . '-' . $request['job_id'] . '.pdf' ;
        $company = Job::select('created_by')->where('id',$request['job_id'])->first();
        $email = User::select('email')->where('id',$company->created_by)->first();
        Mail::to($email->email)->send(new SendMailRegister(
                        $request['intro'], $request['full_name'], $request['gender'],
                        $request['birthday'], $request['university'], $request['major'],
                        $request['email'], $request['phone'], $request['address'],
                        $request['skype_id'], $gpa, $cv));

        $student_apply_job = new StudentApplyJob();
        $student_apply_job->stu_id = Auth::user()->id;
        $student_apply_job->job_id = $request['job_id'];
        $student_apply_job->result = 10;
        $student_apply_job->save();

        $job = Job::find($request['job_id']);
        $job->num_register += 1;
        $job->save();

        return 1000;
    }

    public function postUpdateAva(Request $request){
        if($request->hasFile('update_ava')) {
            $validator = Validator::make($request->all(), [
                'update_ava' => 'required'
            ]);
            if ($validator->failed())
                return -1000;
            $ava = $request->file('update_ava');
            Storage::put('/public/avatars/' . Auth::user()->id .'.png', file_get_contents($ava->getRealPath()));
            $ava_update = Storage::url('/avatars/'.Auth::user()->id.'.png');
//                storage_path().'/app/public/avatars/'.Auth::user()->id . '.png';
            return $ava_update;
        }
        return -1000;
    }
}
