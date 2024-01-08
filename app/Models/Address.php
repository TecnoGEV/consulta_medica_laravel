<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'city',
        'country',
        'number',
        'reference',
    ];

    public function patient() : BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
