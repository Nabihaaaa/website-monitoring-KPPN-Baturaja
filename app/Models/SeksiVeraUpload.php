<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiVeraUpload extends Model
{
    use HasFactory;

    protected $table = 'seksi_vera_upload';

    protected $fillable = [
        'id_seksi_vera',
        'undangan',
        'absensi',
        'foto',
        'notulensi',
        'filename_undangan',
        'type_undangan',
        'filename_absensi',
        'type_absensi',
        'filename_foto',
        'type_foto',
        'filename_notulensi',
        'type_notulensi'
    ];

    public function seksiVera()
    {
        return $this->belongsTo(SeksiVera::class, 'id_seksi_vera');
    }

    public function tambahan()
    {
        return $this->hasMany(SeksiVeraTambahan::class, 'id_seksi_vera');
    }
}

