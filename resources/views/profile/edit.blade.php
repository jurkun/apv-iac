@extends('layouts.app')
@section('title', 'Ganti Password')

@section('content')
<div class="bg-white border border-gray-200 rounded-lg p-6 max-w-md">
    <h2 class="font-semibold mb-1">Ganti Password</h2>
    <p class="text-sm text-gray-500 mb-4">Masuk sebagai: {{ auth()->user()->name }} ({{ auth()->user()->email }})</p>

    <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-4">
        @csrf
        <div>
            <label class="text-sm block mb-1">Password saat ini</label>
            <input type="password" name="current_password" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
        </div>
        <div>
            <label class="text-sm block mb-1">Password baru</label>
            <input type="password" name="password" required minlength="8" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter.</p>
        </div>
        <div>
            <label class="text-sm block mb-1">Ulangi password baru</label>
            <input type="password" name="password_confirmation" required minlength="8" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
        </div>
        <div class="flex gap-2">
            <button class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-medium">Simpan password baru</button>
        </div>
    </form>
</div>
@endsection
