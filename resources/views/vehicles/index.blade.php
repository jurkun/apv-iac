@extends('layouts.app')
@section('title', 'Kendaraan')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('vehicles.create') }}" class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-medium">+ Tambah kendaraan</a>
</div>

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-xs text-gray-500 uppercase border-b bg-gray-50">
                <th class="py-3 px-4">Plat</th><th>Tipe</th><th>Tahun</th><th>Warna</th><th>Pemilik</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicles as $v)
            <tr class="border-b">
                <td class="py-3 px-4"><span class="bg-[#F0A202] text-[#20242B] font-mono font-bold text-xs px-2 py-1 rounded">{{ $v->plat_nomor }}</span></td>
                <td>{{ $v->tipe ?? '-' }}</td>
                <td>{{ $v->tahun ?? '-' }}</td>
                <td>{{ $v->warna ?? '-' }}</td>
                <td>{{ optional($v->member)->nama ?? '-' }}</td>
                <td class="px-4">
                    <form action="{{ route('vehicles.destroy', $v) }}" method="POST" onsubmit="return confirm('Hapus kendaraan ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-gray-400 py-6">Belum ada kendaraan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $vehicles->links() }}</div>
@endsection
