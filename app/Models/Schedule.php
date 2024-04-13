<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $table = "schedules";
    public $fillable = [
        'infant_id',
        'vaccine_id',
        'dose_number',
        'healthcare_provider_id',
        'status',
        'remarks',
        'date',
        'created_at',
        'updated_at'
    ];

    use HasFactory;
}
