@extends('layouts.app')

@section('title', 'Galeri Landing Page')

@section('content')
<h2 class="text-xl font-semibold mb-4">Galeri Landing Page</h2>

<div class="bg-white rounded-lg shadow p-5 mb-6">
    <h3 class="font-medium mb-3">Tambah Foto</h3>
    <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data" class="space-y-3">
        @csrf
        <div>
            <label class="block text-sm mb-1">Foto</label>
            <input type="file" name="foto" accept="image/*" required class="text-sm">
        </div>
        <div class="flex gap-3">
            <div class="flex-1">
                <label class="block text-sm mb-1">Caption</label>
                <input type="text" name="caption" required maxlength="100"
                       class="w-full border rounded px-3 py-2 text-sm" placeholder="Misal: Touring Ciwidey">
            </div>
            <div class="w-32">
                <label class="block text-sm mb-1">Urutan</label>
                <input type="number" name="urutan" min="0" value="0" class="w-full border rounded px-3 py-2 text-sm">
            </div>
        </div>
        <button class="bg-[#F0A202] text-[#20242B] font-medium px-4 py-2 rounded hover:bg-[#d9910a]">
            Unggah Foto
        </button>
    </form>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @forelse($photos as $photo)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->caption }}" class="w-full h-32 object-cover">
            <div class="p-3">
                <p class="text-sm font-medium truncate">{{ $photo->caption }}</p>
                <p class="text-xs text-gray-500 mb-2">Urutan: {{ $photo->urutan }}</p>
                <form method="POST" action="{{ route('gallery.destroy', $photo) }}"
                      onsubmit="return confirm('Hapus foto ini dari galeri?')">
                    @csrf @method('DELETE')
                    <button class="text-xs text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-sm text-gray-500 col-span-full">Belum ada foto. Unggah foto pertama di atas.</p>
    @endforelse
</div>
@endsection
