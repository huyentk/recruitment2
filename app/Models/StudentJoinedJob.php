<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentJoinedJob extends Model
{
    public function studentProfile(){
        return $this->belongsTo('App\Models\StudentApp\ModelsProfile','stu_id');
    }

    public function job(){
        return $this->belongsTo('App\Models\Job','job_id');
    }
}
