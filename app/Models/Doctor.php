<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;


    protected $table = 'doctors';

    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'crm',
    ];

    public function consultation(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function specialization(): BelongsToMany
    {
        return $this->belongsToMany(Specialization::class, 'specialization_doctors', 'doctors_id', 'specialization_id');
    }

    public function plantao_medico() : HasMany
    {
        return $this->hasMany(PlantaoMedico::class);
    }
}
