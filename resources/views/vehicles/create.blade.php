@extends('layouts.app')
@section('title', 'Tambah kendaraan')

@section('content')
<div class="bg-white border border-gray-200 rounded-lg p-6 max-w-xl">
    <h2 class="font-semibold mb-4">Tambah kendaraan</h2>
    <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="text-sm block mb-1">Pemilik / anggota</label>
            <select name="member_id" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                <option value="">Pilih anggota</option>
                @foreach($members as $m)
                    <option value="{{ $m->id }}">{{ $m->nama }} — {{ $m->wilayah }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-sm block mb-1">Plat nomor</label>
            <input type="text" name="plat_nomor" required placeholder="mis. D 1234 ABC" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="text-sm block mb-1">Tipe APV</label>
                <input type="text" name="tipe" placeholder="Arena, GX, dll" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm block mb-1">Tahun</label>
                <input type="number" name="tahun" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm block mb-1">Warna</label>
                <input type="text" name="warna" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
        </div>
        <div>
            <label class="text-sm block mb-1">Foto kendaraan (opsional)</label>
            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
        </div>
        <div class="flex gap-2">
            <button class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-medium">Simpan kendaraan</button>
            <a href="{{ route('vehicles.index') }}" class="border border-gray-300 rounded px-4 py-2 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
