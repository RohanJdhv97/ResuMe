<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySkillMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cutoff',
        'company_id'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
