<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code_specialization',
    ];

    public function specialization(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'specialization_doctors', 'specialization_id', 'doctor_id');
    }
}
