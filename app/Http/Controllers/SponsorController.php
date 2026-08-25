<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::urut()->get();

        return view('sponsors.index', compact('sponsors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'url' => ['nullable', 'string', 'max:255'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'logo' => ['required', 'image', 'max:2048'],
        ]);

        $path = $request->file('logo')->store('sponsors', 'public');

        Sponsor::create([
            'nama' => $data['nama'],
            'url' => $data['url'] ?? null,
            'urutan' => $data['urutan'] ?? 0,
            'logo_path' => $path,
        ]);

        return back()->with('status', 'Sponsor berhasil ditambahkan.');
    }

    public function destroy(Sponsor $sponsor)
    {
        Storage::disk('public')->delete($sponsor->logo_path);
        $sponsor->delete();

        return back()->with('status', 'Sponsor dihapus.');
    }
}
