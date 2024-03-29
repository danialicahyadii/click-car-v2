<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetailInspeksi extends Model
{
    protected $guarded = [];

    protected $table = 'transaksi_detail_inspeksi';

    public function ItemInspeksi()
    {
        return $this->belongsTo(ItemInspeksi::class, 'id_item_inspeksi');
    }
}
