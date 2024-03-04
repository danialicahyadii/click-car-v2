<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDriver extends Model
{
    use HasFactory;
    protected $table = 'master_driver';

    protected $guarded = [];

    /**
     * Get the entitas.
     */
    public function entitas()
    {
        return $this->belongsTo(Entitas::class, 'id_entitas')->withDefault(['nama' => '-']);
    }
}
