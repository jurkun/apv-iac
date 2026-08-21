<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Due extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'bulan', 'nominal', 'tanggal_bayar', 'metode',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
