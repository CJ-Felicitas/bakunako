<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    public $table = 'partners';
    
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'created_at',
        'updated_at'
    ];
}
