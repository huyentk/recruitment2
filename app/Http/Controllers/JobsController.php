<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/11/2017
 * Time: 3:16 PM
 */

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Skill;
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
            'job_skills' => $job_skills,
        ]);
    }
}