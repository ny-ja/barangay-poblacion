<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeInitiative extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'committee_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'budget',
        'source',
        'beneficiaries',
        'contact_person',
        'remarks',
        'initiative_photo_path',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function committee(){
        return $this->belongsTo(Committee::class);
    }
}
