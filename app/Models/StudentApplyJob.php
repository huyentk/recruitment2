<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentApplyJob extends Model
{
    public function studentProfile(){
        return $this->belongsTo('App\Models\StudentProfile','stu_id');
    }

    public function job(){
        return $this->belongsTo('App\Models\Job','job_id');
    }
}
