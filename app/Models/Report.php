<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'laboratory_id',
        'exam_id',
        'patient_id',
        'description_long',
        'documents_repo_complete_url',
    ];
}
