<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'name_instansi',
        'pekerjaan_intansi',
        'tipe_tamu',
        'alamat',
        'pertemuan',
        'keperluan',
        'jam_masuk',
        'jam_keluar',
        'identitas',
        'foto_tamu',
        'foto_identitas',
        'status_keluar',
    ];

    protected $dates = [
        'jam_masuk',
        'jam_keluar',
    ];
    public function getStatusKeluarAttribute($value)
    {
        return $value ?: 'aktif';
    }

    public function getJamMasukAttribute($value)
    {
        return $value ? \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i') : null;
    }
    

    // public function setJamMasukAttribute($value)
    // {
    //     $this->attributes['jam_masuk'] = $value ? $value->format('H:i') : null;
    // }

}
