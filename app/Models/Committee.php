<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'committee_profile',
        'start_date',
        'end_date',
        'contact_number',
        'committee_profile_photo_path',
    ];

    public function user(){
        return $this->belongsTo(User::class);
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
