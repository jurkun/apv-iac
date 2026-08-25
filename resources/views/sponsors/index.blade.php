@extends('layouts.app')

@section('title', 'Sponsor Landing Page')

@section('content')
<h2 class="text-xl font-semibold mb-4">Sponsor Landing Page</h2>
<p class="text-sm text-gray-500 mb-4">Logo di sini akan tampil sebagai slider berjalan di landing page.</p>

<div class="bg-white rounded-lg shadow p-5 mb-6">
    <h3 class="font-medium mb-3">Tambah Sponsor</h3>
    <form method="POST" action="{{ route('sponsors.store') }}" enctype="multipart/form-data" class="space-y-3">
        @csrf
        <div>
            <label class="block text-sm mb-1">Logo (disarankan PNG transparan)</label>
            <input type="file" name="logo" accept="image/*" required class="text-sm">
        </div>
        <div class="flex gap-3">
            <div class="flex-1">
                <label class="block text-sm mb-1">Nama Sponsor</label>
                <input type="text" name="nama" required maxlength="100"
                       class="w-full border rounded px-3 py-2 text-sm" placeholder="Misal: Bengkel Jaya Motor">
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Link Website (opsional)</label>
                <input type="text" name="url" class="w-full border rounded px-3 py-2 text-sm" placeholder="https://...">
            </div>
            <div class="w-28">
                <label class="block text-sm mb-1">Urutan</label>
                <input type="number" name="urutan" min="0" value="0" class="w-full border rounded px-3 py-2 text-sm">
            </div>
        </div>
        <button class="bg-[#F0A202] text-[#20242B] font-medium px-4 py-2 rounded hover:bg-[#d9910a]">
            Tambah Sponsor
        </button>
    </form>
</div>

<div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    @forelse($sponsors as $sponsor)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="h-24 flex items-center justify-center bg-gray-50 p-3">
                <img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="{{ $sponsor->nama }}" class="max-h-full max-w-full object-contain">
            </div>
            <div class="p-3">
                <p class="text-sm font-medium truncate">{{ $sponsor->nama }}</p>
                <p class="text-xs text-gray-500 mb-2">Urutan: {{ $sponsor->urutan }}</p>
                <form method="POST" action="{{ route('sponsors.destroy', $sponsor) }}"
                      onsubmit="return confirm('Hapus sponsor ini?')">
                    @csrf @method('DELETE')
                    <button class="text-xs text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-sm text-gray-500 col-span-full">Belum ada sponsor. Tambahkan di atas.</p>
    @endforelse
</div>
@endsection
