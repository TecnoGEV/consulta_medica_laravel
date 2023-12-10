<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *  title="Appointment",
 *  schema="Appointment"
 * )
 */
class Appointment extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *     property="name",
     *     type="string",
     *     description="Name of the appointment"
     * )
     */
    protected $filable = [
        'name',
    ];
}
