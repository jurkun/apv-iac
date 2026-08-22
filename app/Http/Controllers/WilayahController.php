<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        $wilayahs = Wilayah::orderBy('nama')->get()->map(function ($w) {
            $w->jumlah_anggota = Member::where('wilayah', $w->nama)->count();
            return $w;
        });

        return view('wilayah.index', compact('wilayahs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100', 'unique:wilayahs,nama'],
        ]);

        Wilayah::create($data);

        return back()->with('status', 'Wilayah berhasil ditambahkan.');
    }

    public function destroy(Wilayah $wilayah)
    {
        $adaAnggota = Member::where('wilayah', $wilayah->nama)->exists();

        if ($adaAnggota) {
            return back()->withErrors(['wilayah' => 'Wilayah tidak bisa dihapus karena masih ada anggota di dalamnya.']);
        }

        $wilayah->delete();

        return back()->with('status', 'Wilayah dihapus.');
    }
}
