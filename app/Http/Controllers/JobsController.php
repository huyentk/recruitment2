<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/11/2017
 * Time: 3:16 PM
 */

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\Job;
use App\Models\JobSkill;
use App\Models\Skill;
use App\Models\StudentApplyJob;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class JobsController extends Controller
{
    public function getJobDetail($id){
        $job = Job::where('id',$id)->first();
        $company = $job->companyProfile->company;
        $job_skills = $job->jobSkills;
        foreach ($job_skills as $job_skill){
            $job_skill->skill_name = Skill::select('name')->where('id',$job_skill->skill_id)->first();
        }
        $company->image = Storage::url('companies/'.$company->id.'.png');
        if(!$company->image)
            $company->image = Storage::url('companies/default.png');
        $result = 0;
        if(Auth::user())
        {
            //check if user is student
            if(Auth::user()->role_id == 3){
                $student_apply_job = StudentApplyJob::where('stu_id',Auth::user()->id)->where('job_id',$id)->first();
                if($student_apply_job != null)
                    $result = $student_apply_job->result;
                return view('jobs.job_detail')->with([
                    'job' => $job,
                    'company' => $company,
                    'job_skills' => $job_skills,
                    'result' => $result
                ]);
            }
            if(Auth::user()->role_id == 2){
                if(CompanyProfile::where('id',Auth::user()->id)->value('company_id') == $company->id){
                    $student_apply_job_ids = StudentApplyJob::where('job_id',$id)->get();
                    $students_apply_job = array();
                    if($student_apply_job_ids != null){
                        foreach ($student_apply_job_ids as $student_apply_job_id){
                            $student_info = StudentProfile::find($student_apply_job_id->id)->first();
                            $student_info->full_name = User::find($student_info->id)->value('full_name');
                            Log::info($student_info);
                            array_push($students_apply_job, $student_info);
                        }
                    }
                    return view('jobs.job_detail')->with([
                        'job' => $job,
                        'company' => $company,
                        'students_apply_job' => $students_apply_job,
                        'job_skills' => $job_skills,
                    ]);
                }
                else{
                    return view('jobs.job_detail')->with([
                        'job' => $job,
                        'do_not_show_edit' => '1',
                        'company' => $company,
                        'job_skills' => $job_skills,
                    ]);
                }
            }
        }
        return view('jobs.job_detail')->with([
            'job' => $job,
            'company' => $company,
            'job_skills' => $job_skills,
        ]);
    }

    public function getJobsList()
    {
        $jobs = Job::paginate(8);
//        dd(get_class($jobs)); //show where paginate come from
//        "Illuminate\Pagination\LengthAwarePaginator"
        foreach ($jobs as $job){
            $company_id = CompanyProfile::where('id',$job->created_by)->value('company_id');
            $company = Company::select('name')->where('id',$company_id)->first();
            $job->company_name = $company->name;
            $job->image = Storage::url('/companies/'.$company_id.'.png');
            $skills = JobSkill::select('skill_name')->where('job_id', $job->id)->get();
            $job->skills = $skills;
        }
        return view('jobs.jobs_list')->with([
            'jobs'=> $jobs
        ]);
    }

    public function postJobsList(Request $request)
    {
        $job_skills = JobSkill::where('skill_name','like','%'.$request['skill'].'%')->get();
        $jobs = array();
        foreach ($job_skills as $job_skill)
            array_push($jobs, $job_skill->job);

        foreach ($jobs as $job){
            $company_id = CompanyProfile::where('id',$job->created_by)->pluck('company_id');
            $company = Company::select('name')->where('id',$company_id)->first();
            $job->company_name = $company->name;
            $job->image = Storage::url('/job_images/'.$job->id.'.png');
            $skills = JobSkill::select('skill_name')->where('job_id', $job->id)->get();
            $job->skills = $skills;
        }
        return view('jobs.jobs_list')->with([
            'jobs'=> $jobs,
            'do_not_render' => 1
        ]);
    }

    public function getRegisterJob($job_id){
        if(Auth::guest() || Auth::user()->role_id != 3){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }
        $student_info = User::find(Auth::user()->id);
        $student_info->university = StudentProfile::where('id',Auth::user()->id)->first();
        return view('jobs.register_job')->with([
            'student_info' => $student_info,
            'job_id' => $job_id
        ]);
    }

    public function postUpdateJob(Request $request){
        if(Auth::guest() || Auth::user()->role_id != 2){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }
        try{
            $job = Job::find($request['id']);
            $job->name = $request['name'];
            $job->salary = $request['salary'];
            $job->description = $request['description'];
            $job->requirements = $request['requirement'];
            $job->benefits = $request['benefit'];
            $job->save();
            $job_skill = JobSkill::where('job_id',$request['id'])->delete();
            foreach ($request['skill_array'] as $skill){
                $job_skill = new JobSkill();
                $job_skill->job_id = $request['id'];
                $job_skill->skill_id = $skill['id'];
                $job_skill->skill_name = $skill['name'];
                $job_skill->save();
            }
            return 1000;
        }
        catch (\Exception $e){
            return -1000;
        }
    }

    public function getCreateJob(){
        if(Auth::guest() || Auth::user()->role_id != 2){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }
        $id = Auth::user()->id;
        $company_id = CompanyProfile::where('id',$id)->pluck('company_id');
        $company = Company::find($company_id);
        $company->image = Storage::url('companies/'.$company->id.'.png');
        if(!$company->image)
            $company->image = Storage::url('companies/default.png');
        return view('jobs.create_job')->with([
            'company' => $company,
        ]);
    }

    public function postCreateJob(Request $request){
        if(Auth::guest() || Auth::user()->role_id != 2){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }

        $job = new Job();
        $job->name = $request['name'];
        $job->salary = $request['salary'];
        $job->description = $request['description'];
        $job->requirements = $request['requirement'];
        $job->benefits = $request['benefit'];
        $job->created_by = Auth::user()->id;
        $job->save();

        $max_id = DB::table('jobs')->max('id');

        foreach ($request['skill_array'] as $skill){
            $job_skill = new JobSkill();
            $job_skill->job_id = $max_id;
            $job_skill->skill_id = $skill['id'];
            $job_skill->skill_name = $skill['name'];
            $job_skill->save();
        }

        return 1000;
    }
}