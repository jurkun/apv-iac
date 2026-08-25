<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'judul', 'deskripsi', 'urutan'];

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }
}
