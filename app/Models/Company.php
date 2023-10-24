<?php

namespace App\Models;

use App\Models\CompanyQualificationMaster;
use App\Models\CompanySkillMaster;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }

    public function companyQualifications(){
        return $this->hasMany(CompanyQualificationMaster::class);
    }

    public function companySkills(){
        return $this->hasMany(CompanySkillMaster::class);
    }


}
