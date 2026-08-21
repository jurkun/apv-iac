<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_anggota', 'nama', 'hp', 'email', 'wilayah', 'alamat',
        'tanggal_gabung', 'status', 'foto_ktp',
    ];

    protected $casts = [
        'tanggal_gabung' => 'date',
    ];

    /**
     * Buat kode anggota otomatis format IAC-XXXX berdasarkan nomor urut
     * tertinggi yang sudah ada. Dipakai sebagai saran default di form,
     * dan sebagai fallback kalau field kode_anggota dikosongkan saat simpan.
     */
    public static function generateNextCode(): string
    {
        $lastNumber = self::query()
            ->whereNotNull('kode_anggota')
            ->where('kode_anggota', 'like', 'IAC-%')
            ->get()
            ->map(function ($m) {
                return (int) str_replace('IAC-', '', $m->kode_anggota);
            })
            ->max();

        $next = ($lastNumber ?? 0) + 1;

        return 'IAC-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function dues()
    {
        return $this->hasMany(Due::class);
    }

    /**
     * Batasi query hanya untuk wilayah milik user yang login,
     * kecuali dia admin_pusat (bisa lihat semua).
     */
    public function scopeVisibleTo(Builder $query, $user): Builder
    {
        if ($user->role === 'admin_pusat') {
            return $query;
        }
        return $query->where('wilayah', $user->wilayah);
    }

    public function hasPaidFor(string $bulan): bool
    {
        return $this->dues()->where('bulan', $bulan)->exists();
    }
}
