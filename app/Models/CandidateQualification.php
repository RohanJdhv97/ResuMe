<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'qualification',
        'scored',
        'user_id'
    ];

    public function candidate(){
        return $this->belongsTo(User::class);
    }
}
