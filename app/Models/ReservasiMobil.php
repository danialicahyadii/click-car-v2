<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiMobil extends Model
{
    use HasFactory;

    protected $table = 'reservasi_mobil';

    protected $guarded = [];
    protected $primaryKey = 'id'; // Pastikan sesuai dengan nama kolom primary key

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user')->withDefault(['name' => '-']);
    }
}
