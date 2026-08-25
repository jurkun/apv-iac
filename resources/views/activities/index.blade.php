@extends('layouts.app')

@section('title', 'Kegiatan Landing Page')

@section('content')
<h2 class="text-xl font-semibold mb-4">Kegiatan Landing Page</h2>
<p class="text-sm text-gray-500 mb-4">Bagian "Yang Kami Kerjakan Bersama" di landing page. Maksimal tampil rapi kalau jumlahnya kelipatan 3.</p>

<div class="bg-white rounded-lg shadow p-5 mb-6">
    <h3 class="font-medium mb-3">Tambah Kegiatan</h3>
    <form method="POST" action="{{ route('activities.store') }}" class="space-y-3">
        @csrf
        <div class="flex gap-3">
            <div class="w-40">
                <label class="block text-sm mb-1">Label</label>
                <input type="text" name="label" required maxlength="30" placeholder="KOPDAR"
                       class="w-full border rounded px-3 py-2 text-sm uppercase">
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Judul</label>
                <input type="text" name="judul" required maxlength="80" placeholder="Kopi Darat Rutin"
                       class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div class="w-28">
                <label class="block text-sm mb-1">Urutan</label>
                <input type="number" name="urutan" min="0" value="0" class="w-full border rounded px-3 py-2 text-sm">
            </div>
        </div>
        <div>
            <label class="block text-sm mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="2" required maxlength="300"
                      class="w-full border rounded px-3 py-2 text-sm"></textarea>
        </div>
        <button class="bg-[#F0A202] text-[#20242B] font-medium px-4 py-2 rounded hover:bg-[#d9910a]">
            Tambah Kegiatan
        </button>
    </form>
</div>

<div class="space-y-3">
    @forelse($activities as $activity)
        <div class="bg-white rounded-lg shadow p-4">
            <form method="POST" action="{{ route('activities.update', $activity) }}" class="space-y-3">
                @csrf @method('PUT')
                <div class="flex gap-3">
                    <div class="w-40">
                        <label class="block text-xs text-gray-500 mb-1">Label</label>
                        <input type="text" name="label" value="{{ $activity->label }}" required maxlength="30"
                               class="w-full border rounded px-3 py-2 text-sm uppercase">
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs text-gray-500 mb-1">Judul</label>
                        <input type="text" name="judul" value="{{ $activity->judul }}" required maxlength="80"
                               class="w-full border rounded px-3 py-2 text-sm">
                    </div>
                    <div class="w-28">
                        <label class="block text-xs text-gray-500 mb-1">Urutan</label>
                        <input type="number" name="urutan" value="{{ $activity->urutan }}" min="0"
                               class="w-full border rounded px-3 py-2 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="2" required maxlength="300"
                              class="w-full border rounded px-3 py-2 text-sm">{{ $activity->deskripsi }}</textarea>
                </div>
                <div class="flex gap-3">
                    <button class="text-sm bg-[#20242B] text-white px-3 py-1.5 rounded hover:bg-[#333]">Simpan</button>
                </div>
            </form>
            <form method="POST" action="{{ route('activities.destroy', $activity) }}"
                  onsubmit="return confirm('Hapus kegiatan ini?')" class="mt-2">
                @csrf @method('DELETE')
                <button class="text-xs text-red-600 hover:underline">Hapus</button>
            </form>
        </div>
    @empty
        <p class="text-sm text-gray-500">Belum ada kegiatan. Tambahkan di atas.</p>
    @endforelse
</div>
@endsection
