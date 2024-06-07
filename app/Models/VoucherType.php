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
        'partner_id',
        'item_name',
        'total_quantity',
        'redeeemed_quantity',
        'vaccine_id',
        'created_at',
        'updated_at'
    ];

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function partners(){
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    public function vaccines(){
        return $this->belongsTo(Vaccine::class, 'vaccine_id');
    }

    use HasFactory;
}
