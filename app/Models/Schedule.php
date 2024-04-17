<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $table = "schedules";
    public $fillable = [
        'infants_id',
        'vaccines_id',
        'dose_number',
        'healthcare_provider_id',
        'status',
        'remarks',
        'date',
        'created_at',
        'updated_at'
    ];

    public function infant()
    {
        return $this->belongsTo(Infant::class, 'infants_id');
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccines_id');
    }
}
