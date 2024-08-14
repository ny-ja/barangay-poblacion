<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user(){
        
        return $this->belongsTo(User::class);
    }

    public function news(){
        
        return $this->hasMany(News::class);
    }
}
