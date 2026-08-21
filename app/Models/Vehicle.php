<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'plat_nomor', 'tipe', 'tahun', 'warna', 'foto',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
