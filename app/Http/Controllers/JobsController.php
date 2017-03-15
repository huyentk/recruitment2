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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class JobsController
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
        return view('jobs.job_detail')->with([
            'job' => $job,
            'company' => $company,
            'job_skills' => $job_skills
        ]);
    }

    public function getJobsList()
    {
        $jobs = Job::paginate(8);
//        dd(get_class($jobs)); //show where paginate come from
//        "Illuminate\Pagination\LengthAwarePaginator"
        foreach ($jobs as $job){
            $company_id = CompanyProfile::where('id',$job->created_by)->pluck('company_id');
            $company = Company::select('name')->where('id',$company_id)->first();
            $job->company_name = $company->name;
            $job->image = Storage::url('/job_images/'.$job->id.'.png');
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
}