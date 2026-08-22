@extends('layouts.app')
@section('title', 'Iuran')

@section('content')
<div class="flex justify-between items-center mb-4 flex-wrap gap-3">
    <form method="GET" class="flex gap-2 items-center">
        <input type="month" name="bulan" value="{{ $bulan }}" class="border border-gray-300 rounded px-3 py-2 text-sm">
        <button class="border border-gray-300 rounded px-3 py-2 text-sm bg-white">Filter</button>
    </form>
    <div class="flex gap-2">
        <a href="{{ route('export.dues', ['bulan' => $bulan]) }}" class="border border-gray-300 bg-white rounded px-3 py-2 text-sm">Export Excel</a>
        <a href="{{ route('dues.create') }}" class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-medium">+ Catat iuran</a>
    </div>
</div>

<div class="bg-white border border-gray-200 rounded-lg overflow-x-auto">
    <table class="w-full text-sm min-w-[600px]">
        <thead>
            <tr class="text-left text-xs text-gray-500 uppercase border-b bg-gray-50">
                <th class="py-3 px-4">Nama</th><th>Wilayah</th><th>Bulan</th><th>Nominal</th><th>Tgl bayar</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($dues as $d)
            <tr class="border-b">
                <td class="py-3 px-4">{{ optional($d->member)->nama ?? '-' }}</td>
                <td><span class="bg-indigo-50 text-indigo-700 text-xs px-2 py-1 rounded">{{ optional($d->member)->wilayah ?? '-' }}</span></td>
                <td>{{ $d->bulan }}</td>
                <td>Rp{{ number_format($d->nominal, 0, ',', '.') }}</td>
                <td>{{ optional($d->tanggal_bayar)->format('d M Y') }}</td>
                <td class="px-4">
                    <form action="{{ route('dues.destroy', $d) }}" method="POST" onsubmit="return confirm('Hapus catatan ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-gray-400 py-6">Belum ada riwayat iuran.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $dues->links() }}</div>
@endsection
