<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    public $table = "vaccines";
    public $fillable = [
        'name',
        'description',
        'days_count',
        'created_at',
        'updated_at'
    ];
    use HasFactory;
}
