<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jabatan', 'foto_path', 'urutan'];

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }
}
