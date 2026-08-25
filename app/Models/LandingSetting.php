<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LandingSetting extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['key', 'value'];

    /**
     * Ambil semua setting sebagai array [key => value], di-cache 60 menit
     * supaya landing page publik tidak query berkali-kali.
     */
    public static function allCached(): array
    {
        return Cache::remember('landing_settings', 3600, function () {
            return self::query()->pluck('value', 'key')->toArray();
        });
    }

    public static function forgetCache(): void
    {
        Cache::forget('landing_settings');
    }
}
