<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializationDoctor extends Model
{
    use HasFactory;

    protected $table = 'specialization_doctors';

    protected $fillable = [
        'doctor_id',
        'specialization_id',
    ];
}
