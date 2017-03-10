<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function jobSkills(){
        return $this->hasMany('App\Models\JobSkill','skill_id');
    }
}
