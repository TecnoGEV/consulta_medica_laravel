<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecializationDoctor extends Model
{
    use HasFactory;

    protected $table = 'specialization_doctors';

    protected $fillable = [
        'doctor_id',
        'specialization_id',
    ];

    public function specilizations(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    public function doctors(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
