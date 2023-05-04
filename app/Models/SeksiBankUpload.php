<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiBankUpload extends Model
{
    use HasFactory;

    protected $table = 'seksi_bank_upload';

    protected $fillable = [
        'id_seksi_bank',
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

    public function seksiBank()
    {
        return $this->belongsTo(SeksiBank::class, 'id_seksi_bank');
    }

    public function tambahan()
    {
        return $this->hasMany(BagianUmumTambahan::class, 'id_seksi_bank');
    }
}
