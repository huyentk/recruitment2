<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function companyProfiles(){
        return $this->hasMany('App\Models\CompanyProfile','company_id');
    }

}
