<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infant extends Model
{
    use HasFactory;
    protected $table = 'infants';
    protected $fillable = [
        'infant_firstname',
        'infant_lastname',
        'infant_middlename',
        'date_of_birth',
        'place_of_birth',
        'father_firstname',
        'father_lastname',
        'father_middlename',
        'mother_firstname',
        'mother_lastname',
        'mother_middlename',
        'address',
        'sex',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
