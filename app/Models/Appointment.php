<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    protected $fillable = [
        'date_appointment',
        'hours_appointment',
        'type_appointment',
    ];

    protected $hidden=[
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    

    public function createPatientApointment(array $arrayParam) : self
    {
        $appointment = Patient::find($arrayParam['patient']);
        return $appointment->appointments()->create($arrayParam);
    }


}
