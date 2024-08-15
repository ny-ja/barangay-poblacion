<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayOfficial extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'user_id',
        'position',
        'start_date',
        'end_date',
        'contact_number',
        'email',
        'address',
        'photo_path',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
