<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyQualificationMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'qualification',
        'threshold',
        'company_id'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
