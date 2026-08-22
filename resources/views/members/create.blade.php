@extends('layouts.app')
@section('title', 'Tambah anggota')

@section('content')
<div class="bg-white border border-gray-200 rounded-lg p-6 max-w-xl">
    <h2 class="font-semibold mb-4">Tambah anggota baru</h2>
    <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="text-sm block mb-1">ID Anggota</label>
            <input type="text" name="kode_anggota" value="{{ old('kode_anggota', $suggestedCode) }}" placeholder="IAC-XXXX" class="w-full border border-gray-300 rounded px-3 py-2 text-sm font-mono">
            <p class="text-xs text-gray-500 mt-1">Diisi otomatis format berikutnya, boleh diganti manual kalau perlu.</p>
        </div>
        <div>
            <label class="text-sm block mb-1">Nama lengkap</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm block mb-1">No. HP / WhatsApp</label>
                <input type="text" name="hp" value="{{ old('hp') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
        </div>

        @if(auth()->user()->role === 'admin_pusat')
        <div>
            <label class="text-sm block mb-1">Wilayah</label>
            <select name="wilayah" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                <option value="">Pilih wilayah</option>
                @foreach($wilayahs as $w)
                    <option value="{{ $w->nama }}" {{ old('wilayah') === $w->nama ? 'selected' : '' }}>{{ $w->nama }}</option>
                @endforeach
            </select>
            @if($wilayahs->isEmpty())
                <p class="text-xs text-red-600 mt-1">Belum ada wilayah terdaftar. <a href="{{ route('wilayah.index') }}" class="underline">Tambahkan dulu di sini</a>.</p>
            @endif
        </div>
        @else
        <input type="hidden" name="wilayah" value="{{ auth()->user()->wilayah }}">
        <p class="text-xs text-gray-500">Wilayah otomatis: {{ auth()->user()->wilayah }}</p>
        @endif

        <div>
            <label class="text-sm block mb-1">Alamat</label>
            <textarea name="alamat" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">{{ old('alamat') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm block mb-1">Tanggal gabung</label>
                <input type="date" name="tanggal_gabung" value="{{ old('tanggal_gabung') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm block mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non-aktif</option>
                </select>
            </div>
        </div>
        <div>
            <label class="text-sm block mb-1">Foto anggota (untuk kartu member)</label>
            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
        </div>
        <div>
            <label class="text-sm block mb-1">Foto KTP (opsional)</label>
            <input type="file" name="foto_ktp" accept="image/*" class="w-full text-sm">
        </div>
        <div class="flex gap-2">
            <button class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-medium">Simpan anggota</button>
            <a href="{{ route('members.index') }}" class="border border-gray-300 rounded px-4 py-2 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
