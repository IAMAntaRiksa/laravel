<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'tujuan_id',
        'kehadiran',
    ];

    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class);
    }
}




