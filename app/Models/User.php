<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\CandidateAssessment;
use App\Models\CandidateExperience;
use App\Models\CandidateQualification;
use App\Models\CandidateSkill;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'email',
        'phone',
        'role_id',
        'company_id',
        'url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function candidateSkills(){
        return $this->hasMany(CandidateSkill::class);
    }

    public function candidateQualification(){
        return $this->hasMany(CandidateQualification::class);
    }

    public function candidateExperience(){
        return $this->hasMany(CandidateExperience::class);
    }

    public function candidateAssessment(){
        return $this->hasOne(CandidateAssessment::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
    public function getFilamentName(): string
    {
        return $this->fullName;
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function name(){
        return $this->first_name;
    }

}
