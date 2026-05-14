<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'user_id',
        'units',
        'name',
        'dob',
        'address',
        'email',
        'phone',
        'blood_type',
        'eligible',
        'status',
        'id_type',
        'health_notes',
    ];

    /**
     * Type casting
     */
    protected $casts = [
        'dob' => 'date',
        'eligible' => 'boolean',
    ];

    /**
     * Relationship: Donation belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}