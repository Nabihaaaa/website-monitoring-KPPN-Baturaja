<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiKegiatan extends Model
{
    use HasFactory;

    protected $table = 'referensi_kegiatan';

    protected $fillable = [
        'nama'
    ];
   
}
