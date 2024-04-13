<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'master_driver';

    /**
     * Get the entitas.
     */
    public function entitas()
    {
        return $this->belongsTo(Entitas::class, 'id_entitas')->withDefault(['nama' => '-']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user')->withDefault(['nama' => '-']);
    }
}
