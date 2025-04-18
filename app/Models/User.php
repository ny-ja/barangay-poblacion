<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'profile_photo_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function newsCategory(){
        
        return $this->hasMany(NewsCategory::class);
    }

    public function documentCategory(){
        
        return $this->hasMany(DocumentCategory::class);
    }

    public function documentType(){
        
        return $this->hasMany(DocumentType::class);
    }

    public function document(){
        
        return $this->hasMany(Document::class);
    }

    public function news(){
        
        return $this->hasMany(News::class);
    }

    public function barangayOfficial(){
        
        return $this->hasMany(BarangayOfficial::class);
    }

    public function committee(){
        
        return $this->hasMany(Committee::class);
    }

    public function committeeMember(){
        
        return $this->hasMany(CommitteeMember::class);
    }

    public function committeeDocument(){
        
        return $this->hasMany(CommitteeDocument::class);
    }

    public function committeeInitiative(){
        
        return $this->hasMany(CommitteeInitiative::class);
    }
}
