<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill',
        'score'
    ];

    public function candidate(){
        return $this->belongsTo(User::class);
    }
}
