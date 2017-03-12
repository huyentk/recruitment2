<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function jobSkills(){
        return $this->hasMany('App\Models\JobSkill','job_id');
    }

    public function studentApplyJobs(){
        return $this->hasMany('App\Models\StudentApplyJob','job_id');
    }

    public function studentJoinedJobs(){
        return $this->hasMany('App\Models\StudentJoinedJob','job_id');
    }

    public function companyProfile(){
        return $this->belongsTo('App\Models\CompanyProfile','created_by','id');
    }
}
