<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izin extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'keterangan',
        'alasan',
        'mulai',
        'selesai',
        'bukti',
        'status',
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
