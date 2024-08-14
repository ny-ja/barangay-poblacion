<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
        'user_id',
        'document_category_id',
        'document_type_id'
    ];

    public function documentCategory(){
        return $this->belongsTo(DocumentCategory::class);
    }

    public function documentType(){
        return $this->belongsTo(DocumentType::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}