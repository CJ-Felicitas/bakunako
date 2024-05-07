<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveVoucher extends Model
{
    use HasFactory;
    public $table = 'voucher_distribution_active';

    public $fillable = [
        'vaccine_id',
        'voucher_type_id'
    ];

    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class, 'voucher_type_id');
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id');
    }
}
