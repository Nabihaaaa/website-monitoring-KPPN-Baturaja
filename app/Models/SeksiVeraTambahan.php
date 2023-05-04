<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiVeraTambahan extends Model
{
    use HasFactory;

    protected $table = 'seksi_vera_tambahan';

    protected $fillable = [
        'id_seksi_vera',
        'tambahan',
        'filename_tambahan',
        'type_tambahan'
    ];

    public function upload()
    {
        return $this->belongsTo(SeksiVeraUpload::class, 'id_seksi_vera');
    }
}