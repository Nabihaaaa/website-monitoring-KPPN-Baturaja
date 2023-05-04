<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiMskiTambahan extends Model
{
    use HasFactory;

    protected $table = 'seksi_mski_tambahan';

    protected $fillable = [
        'id_seksi_mski',
        'tambahan',
        'filename_tambahan',
        'type_tambahan'
    ];

    public function upload()
    {
        return $this->belongsTo(SeksiMskiUpload::class, 'id_seksi_mski');
    }
}
