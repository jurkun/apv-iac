<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizerController extends Controller
{
    public function index()
    {
        $organizers = Organizer::urut()->get();

        return view('organizers.index', compact('organizers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'jabatan' => ['required', 'string', 'max:100'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('organizers', 'public');
        }

        Organizer::create($data);

        return back()->with('status', 'Pengurus berhasil ditambahkan.');
    }

    public function destroy(Organizer $organizer)
    {
        if ($organizer->foto_path) {
            Storage::disk('public')->delete($organizer->foto_path);
        }
        $organizer->delete();

        return back()->with('status', 'Pengurus dihapus.');
    }
}
