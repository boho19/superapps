<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'bukti',
        'latitude',
        'longitude',
        'jarak',
        'waktu_masuk',
        'waktu_keluar',
        'kehadiran',
        'status'
    ];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

}
