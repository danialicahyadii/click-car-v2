<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiVoucher extends Model
{
    use HasFactory;

    protected $table = 'transaksi_vouchers';

    protected $guarded = [];
}
