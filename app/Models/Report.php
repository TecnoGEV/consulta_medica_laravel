<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description_long',
        'documents_repo_complete_url',
    ];

    public function laboratory(): BelongsTo 
    {
        return $this->belongsTo(Laboratory::class);
    }
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
