<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateSkill extends Model
{
    use HasFactory;

    public function candidate(){
        return $this->belongsTo(User::class);
    }
}
