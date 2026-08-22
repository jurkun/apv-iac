@extends('layouts.app')
@section('title', 'Edit anggota')

@section('content')
<div class="bg-white border border-gray-200 rounded-lg p-6 max-w-xl">
    <h2 class="font-semibold mb-4">Edit anggota — {{ $member->nama }}</h2>
    <form method="POST" action="{{ route('members.update', $member) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="text-sm block mb-1">ID Anggota</label>
            <input type="text" name="kode_anggota" value="{{ old('kode_anggota', $member->kode_anggota) }}" placeholder="IAC-XXXX" class="w-full border border-gray-300 rounded px-3 py-2 text-sm font-mono">
        </div>
        <div>
            <label class="text-sm block mb-1">Nama lengkap</label>
            <input type="text" name="nama" value="{{ old('nama', $member->nama) }}" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm block mb-1">No. HP / WhatsApp</label>
                <input type="text" name="hp" value="{{ old('hp', $member->hp) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $member->email) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
        </div>
        <div>
            <label class="text-sm block mb-1">Wilayah</label>
            @if(auth()->user()->role === 'admin_pusat')
            <select name="wilayah" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                @foreach($wilayahs as $w)
                    <option value="{{ $w->nama }}" {{ old('wilayah', $member->wilayah) === $w->nama ? 'selected' : '' }}>{{ $w->nama }}</option>
                @endforeach
            </select>
            @else
            <input type="text" value="{{ $member->wilayah }}" readonly class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-100">
            <input type="hidden" name="wilayah" value="{{ $member->wilayah }}">
            @endif
        </div>
        <div>
            <label class="text-sm block mb-1">Alamat</label>
            <textarea name="alamat" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">{{ old('alamat', $member->alamat) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm block mb-1">Tanggal gabung</label>
                <input type="date" name="tanggal_gabung" value="{{ old('tanggal_gabung', optional($member->tanggal_gabung)->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm block mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    <option value="aktif" {{ $member->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ $member->status === 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                </select>
            </div>
        </div>
        <div>
            <label class="text-sm block mb-1">Foto anggota (untuk kartu member)</label>
            @if($member->foto)
                <img src="{{ asset('storage/' . $member->foto) }}" class="h-20 rounded border mb-2">
            @endif
            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
        </div>
        <div>
            <label class="text-sm block mb-1">Foto KTP</label>
            @if($member->foto_ktp)
                <img src="{{ asset('storage/' . $member->foto_ktp) }}" class="h-20 rounded border mb-2">
            @endif
            <input type="file" name="foto_ktp" accept="image/*" class="w-full text-sm">
        </div>
        <div class="flex gap-2">
            <button class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-medium">Simpan perubahan</button>
            <a href="{{ route('members.index') }}" class="border border-gray-300 rounded px-4 py-2 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
