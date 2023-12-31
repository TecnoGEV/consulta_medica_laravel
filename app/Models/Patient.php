<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\ValidaCPF;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
    use ValidaCPF;

    protected $fillable = [
        'first_name',
        'last_name',
        'cpf',
        'birthday',
        'gender_biological',
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    protected function firstName(): Attribute 
    {
        return Attribute::make(
            get: fn (string $first_name) => ucfirst($first_name),
            set: function(string $first_name) {
                return strtoupper($first_name);
            }
        );
    }

    protected function cpf(): Attribute
    {
        return Attribute::make(
            set: fn (string $cpf) => self::trataCpf($cpf)
        );
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
