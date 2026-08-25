<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoController extends Controller
{
    public function index()
    {
        $photos = GalleryPhoto::urut()->get();

        return view('gallery.index', compact('photos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => ['required', 'string', 'max:100'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'foto' => ['required', 'image', 'max:4096'],
        ]);

        $path = $request->file('foto')->store('gallery', 'public');

        GalleryPhoto::create([
            'caption' => $data['caption'],
            'urutan' => $data['urutan'] ?? 0,
            'image_path' => $path,
        ]);

        return back()->with('status', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function destroy(GalleryPhoto $galleryPhoto)
    {
        Storage::disk('public')->delete($galleryPhoto->image_path);
        $galleryPhoto->delete();

        return back()->with('status', 'Foto dihapus dari galeri.');
    }
}
