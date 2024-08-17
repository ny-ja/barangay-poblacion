<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
        'user_id',
        'committee_id',
        'document_type_id'
    ];

    public function committee(){
        return $this->belongsTo(Committee::class);
    }

    public function documentType(){
        return $this->belongsTo(DocumentType::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
