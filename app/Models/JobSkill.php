<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    public function skill(){
        return $this->belongsTo('App\Models\Skill','skill_id');
    }

    public function job(){
        return $this->belongsTo('App\Models\Job','job_id');
    }
}
