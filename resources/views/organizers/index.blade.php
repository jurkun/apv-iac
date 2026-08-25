@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
<h2 class="text-xl font-semibold mb-4">Struktur Organisasi</h2>
<p class="text-sm text-gray-500 mb-4">Urutan kecil tampil duluan (misal Ketua = 1, Wakil = 2, dst).</p>

<div class="bg-white rounded-lg shadow p-5 mb-6">
    <h3 class="font-medium mb-3">Tambah Pengurus</h3>
    <form method="POST" action="{{ route('organizers.store') }}" enctype="multipart/form-data" class="space-y-3">
        @csrf
        <div>
            <label class="block text-sm mb-1">Foto (opsional)</label>
            <input type="file" name="foto" accept="image/*" class="text-sm">
        </div>
        <div class="flex gap-3">
            <div class="flex-1">
                <label class="block text-sm mb-1">Nama</label>
                <input type="text" name="nama" required maxlength="100" class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Jabatan</label>
                <input type="text" name="jabatan" required maxlength="100"
                       class="w-full border rounded px-3 py-2 text-sm" placeholder="Misal: Ketua Umum">
            </div>
            <div class="w-28">
                <label class="block text-sm mb-1">Urutan</label>
                <input type="number" name="urutan" min="0" value="0" class="w-full border rounded px-3 py-2 text-sm">
            </div>
        </div>
        <button class="bg-[#F0A202] text-[#20242B] font-medium px-4 py-2 rounded hover:bg-[#d9910a]">
            Tambah Pengurus
        </button>
    </form>
</div>

<div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    @forelse($organizers as $o)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="h-28 bg-gray-100 flex items-center justify-center">
                @if($o->foto_path)
                    <img src="{{ asset('storage/' . $o->foto_path) }}" alt="{{ $o->nama }}" class="w-full h-full object-cover">
                @else
                    <span class="text-gray-400 text-2xl">👤</span>
                @endif
            </div>
            <div class="p-3">
                <p class="text-sm font-medium truncate">{{ $o->nama }}</p>
                <p class="text-xs text-gray-500 mb-2">{{ $o->jabatan }} · urutan {{ $o->urutan }}</p>
                <form method="POST" action="{{ route('organizers.destroy', $o) }}"
                      onsubmit="return confirm('Hapus pengurus ini?')">
                    @csrf @method('DELETE')
                    <button class="text-xs text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-sm text-gray-500 col-span-full">Belum ada data pengurus. Tambahkan di atas.</p>
    @endforelse
</div>
@endsection
