@extends('layouts.app')
@section('title', 'Catat iuran')

@section('content')
<div class="bg-white border border-gray-200 rounded-lg p-6 max-w-xl">
    <h2 class="font-semibold mb-4">Catat pembayaran iuran</h2>
    <form method="POST" action="{{ route('dues.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="text-sm block mb-1">Anggota</label>
            <select name="member_id" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                <option value="">Pilih anggota</option>
                @foreach($members as $m)
                    <option value="{{ $m->id }}">{{ $m->nama }} — {{ $m->wilayah }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm block mb-1">Bulan iuran</label>
                <input type="month" name="bulan" required value="{{ now()->format('Y-m') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm block mb-1">Nominal (Rp)</label>
                <input type="number" name="nominal" required value="50000" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
        </div>
        <div>
            <label class="text-sm block mb-1">Metode pembayaran</label>
            <select name="metode" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                <option value="tunai">Tunai</option>
                <option value="transfer">Transfer bank</option>
                <option value="qris">QRIS</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-medium">Catat lunas</button>
            <a href="{{ route('dues.index') }}" class="border border-gray-300 rounded px-4 py-2 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
