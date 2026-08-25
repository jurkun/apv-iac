@extends('layouts.app')

@section('title', 'Pengaturan Landing Page')

@section('content')
<h2 class="text-xl font-semibold mb-4">Pengaturan Landing Page</h2>

<form method="POST" action="{{ route('landing-settings.update') }}" class="bg-white rounded-lg shadow p-5 space-y-4 max-w-2xl">
    @csrf @method('PUT')

    <div>
        <label class="block text-sm mb-1">Judul Hero — baris 1</label>
        <input type="text" name="hero_title_1" value="{{ old('hero_title_1', $settings['hero_title_1'] ?? '') }}"
               class="w-full border rounded px-3 py-2 text-sm" required>
    </div>
    <div>
        <label class="block text-sm mb-1">Judul Hero — baris 2</label>
        <input type="text" name="hero_title_2" value="{{ old('hero_title_2', $settings['hero_title_2'] ?? '') }}"
               class="w-full border rounded px-3 py-2 text-sm" required>
    </div>
    <div>
        <label class="block text-sm mb-1">Judul Hero — baris 3</label>
        <input type="text" name="hero_title_3" value="{{ old('hero_title_3', $settings['hero_title_3'] ?? '') }}"
               class="w-full border rounded px-3 py-2 text-sm" required>
    </div>
    <div>
        <label class="block text-sm mb-1">Deskripsi singkat (lede)</label>
        <textarea name="hero_lede" rows="3" required
                  class="w-full border rounded px-3 py-2 text-sm">{{ old('hero_lede', $settings['hero_lede'] ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm mb-1">Tahun Berdiri</label>
        <input type="text" name="tahun_berdiri" value="{{ old('tahun_berdiri', $settings['tahun_berdiri'] ?? '') }}"
               class="w-full border rounded px-3 py-2 text-sm" required>
    </div>
    <div>
        <label class="block text-sm mb-1">Link Instagram</label>
        <input type="text" name="ig_url" value="{{ old('ig_url', $settings['ig_url'] ?? '') }}"
               class="w-full border rounded px-3 py-2 text-sm" placeholder="https://instagram.com/...">
    </div>
    <div>
        <label class="block text-sm mb-1">Link WhatsApp Grup Pendaftaran</label>
        <input type="text" name="wa_url" value="{{ old('wa_url', $settings['wa_url'] ?? '') }}"
               class="w-full border rounded px-3 py-2 text-sm" placeholder="https://wa.me/...">
    </div>
    <div>
        <label class="block text-sm mb-1">Email Kontak</label>
        <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}"
               class="w-full border rounded px-3 py-2 text-sm">
    </div>

    <button class="bg-[#F0A202] text-[#20242B] font-medium px-4 py-2 rounded hover:bg-[#d9910a]">
        Simpan Perubahan
    </button>
</form>

<p class="text-sm text-gray-500 mt-3">
    Catatan: jumlah anggota &amp; jumlah kota di landing page dihitung otomatis dari data Anggota, tidak perlu diisi manual.
</p>
@endsection
