<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Translation\Test\ProviderTestCase;

class CandidateExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'details',
        'experience_in_months',
        'technologies'
    ];

    protected $casts = [
        'technologies' => 'json'
    ];

    public function candidate(){
        return $this->belongsTo(User::class);
    }
}
