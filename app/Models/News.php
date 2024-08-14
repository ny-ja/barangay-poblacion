<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'news_photo_path',
        'user_id',
        'news_category_id'
    ];

    public function newsCategory(){
        return $this->belongsTo(NewsCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
