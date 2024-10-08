<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user(){
        
        return $this->belongsTo(User::class);
    }

    public function document(){
        
        return $this->hasMany(Document::class);
    }

    public function committeeDocument(){
        
        return $this->hasMany(CommitteeDocument::class);
    }
}
