<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'id');
    }

    public function studentApplyJobs(){
        return $this->hasMany('App\Models\StudentApplyJob','stu_id');
    }

    public function studentJoinedJobs(){
        return $this->hasMany('App\Models\StudentJoinedJob','stu_id');
    }
}
