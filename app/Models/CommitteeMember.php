<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'user_id',
        'committee_id',
        'position',
        'start_date',
        'end_date',
        'contact_number',
        'email',
        'address',
        'role',
        'profile',
        'member_photo_path',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function committee(){
        return $this->belongsTo(Committee::class);
    }
}
