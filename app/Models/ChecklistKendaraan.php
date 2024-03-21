<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistKendaraan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'checklist_kendaraan';
}
