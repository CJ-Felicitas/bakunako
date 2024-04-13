<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $table = "voucher";

    /**
     * apply the fillable fields
     * 
     */
    protected $fillable = [
        'voucher_type_id',
        'infant_id',
        'voucher_code',
        'reedamable',
        'claimed',
        'created_at',
        'updated_at'
    ];
    
    use HasFactory;
}
