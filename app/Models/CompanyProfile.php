<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'id');
    }

    public function jobs(){
        return $this->hasMany('App\Models\Job');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company','company_id','id');
    }
}
