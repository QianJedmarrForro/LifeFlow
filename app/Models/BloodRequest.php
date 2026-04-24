<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BloodRequest extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'user_id',
        'hospital',
        'blood_type',
        'units',
        'priority',
        'needed_by',
        'patient_name',
        'reason',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'needed_by' => 'date',
    ];

    /**
     * Relationship: BloodRequest belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}