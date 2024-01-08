<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\ValidateCPF;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @OA\Schema(
 *  title="Patient",
 *  schema="Patient"
 * )
 */
class Patient extends Model
{
    use HasFactory;
    use ValidateCPF;

    protected $table= 'patients';

    protected $primaryKey = 'id';


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
            set: fn(string $first_name) => strtoupper($first_name)
        );
    }

    protected function birthday(): Attribute
    {
        return Attribute::make(
            get: fn(string $birthday) => $birthday,
            set: function (string $birthday) {
                $birthday = new \DateTime($birthday);
                return $birthday->format('Y-m-d');
            }
        );
    }

    protected function maiorIdade() : int
    {
        return 18;
    }
    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn(string $cpf) => $cpf,
            set: fn (string $cpf) => self::cpf_invalid($cpf)
        );
    }



    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
