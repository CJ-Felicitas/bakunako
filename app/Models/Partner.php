<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;
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
