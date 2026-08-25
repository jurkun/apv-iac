<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'hp', 'email', 'wilayah', 'alamat',
        'tipe_kendaraan', 'no_polisi', 'status', 'catatan_admin', 'member_id',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
