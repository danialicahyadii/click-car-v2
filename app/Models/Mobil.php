<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'master_mobil';

    protected $guarded = [];

    /**
     * Get the entitas.
     */
    public function entitas()
    {
        return $this->belongsTo(Entitas::class, 'id_entitas')->withDefault(['nama' => '-']);
    }

    /**
     * Get the status.
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status')->withDefault(['status' => '-']);
    }

    /**
     * Get the pic.
     */
    public function driver()
    {
        return $this->belongsTo(Supir::class, 'id_supir')->withDefault(['nama' => 'Belum memiliki PIC']);
    }

    public function Plat()
    {
        return $this->belongsTo(Plat::class, 'id_plat')->withDefault(['nomor_plat' => '-']);
    }

    public function jenis_kendaraan()
    {
        return $this->belongsTo(JenisKendaraan::class, 'id_jenis_kendaraan')->withDefault(['nama' => '-']);
    }

}
