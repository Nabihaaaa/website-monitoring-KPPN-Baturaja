<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiMskiUpload extends Model
{
    use HasFactory;

    protected $table = 'seksi_mski_upload';

    protected $fillable = [
        'id_seksi_mski',
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

    public function seksiMski()
    {
        return $this->belongsTo(SeksiMski::class, 'id_seksi_mski');
    }

    public function tambahan()
    {
        return $this->hasMany(SeksiMskiTambahan::class, 'id_seksi_mski');
    }
}
