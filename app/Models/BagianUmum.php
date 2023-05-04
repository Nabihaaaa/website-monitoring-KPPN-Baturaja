<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianUmum extends Model
{
    use HasFactory;

    protected $table = 'bagian_umum';

    protected $fillable = [
        'kegiatan',
        'nama_kegiatan',
        'tgl_pelaksanaan',
        'pukul',
        'tempat',
        'pic',
        'SB',
        'realisasi_pelaksanaan',
        'penyelenggara'
    ];

    public function upload()
    {
        return $this->hasOne(BagianUmumUpload::class, 'id_bagian_umum');
    }
    
    public static function getBelumSelesai()
    {
        return BagianUmum::select('id', 'kegiatan', 'nama_kegiatan', 'tgl_pelaksanaan', 'pukul', 'tempat', 'pic', 'SB', 'realisasi_pelaksanaan', 'penyelenggara')
            ->union(SeksiBank::select('id', 'kegiatan', 'nama_kegiatan', 'tgl_pelaksanaan', 'pukul', 'tempat', 'pic', 'SB', 'realisasi_pelaksanaan', 'penyelenggara'))
            ->union(SeksiPencairanDana::select('id', 'kegiatan', 'nama_kegiatan', 'tgl_pelaksanaan', 'pukul', 'tempat', 'pic', 'SB', 'realisasi_pelaksanaan', 'penyelenggara'))
            ->union(SeksiVera::select('id', 'kegiatan', 'nama_kegiatan', 'tgl_pelaksanaan', 'pukul', 'tempat', 'pic', 'SB', 'realisasi_pelaksanaan', 'penyelenggara'))
            ->union(SeksiMSKI::select('id', 'kegiatan', 'nama_kegiatan', 'tgl_pelaksanaan', 'pukul', 'tempat', 'pic', 'SB', 'realisasi_pelaksanaan', 'penyelenggara'))
            ->where('SB', 'Belum' )
            ->get();
    }
}




