<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *  title="Patient",
 *  schema="Patient"
 * )
 */
class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'gender_biological',
    ];

    public function maiorDeIdade(string $birthday): bool
    {
        return true;
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
