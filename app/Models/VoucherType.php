<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    public $table = "voucher_type";
    /**
     * apply the fillable fields
     * 
     */
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at'
    ];
    
    use HasFactory;
}
