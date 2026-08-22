@extends('layouts.app')
@section('title', 'Wilayah')

@section('content')
<div class="bg-white border border-gray-200 rounded-lg p-6 max-w-lg mb-6">
    <h2 class="font-semibold mb-4">Tambah wilayah baru</h2>
    <form method="POST" action="{{ route('wilayah.store') }}" class="flex gap-2">
        @csrf
        <input type="text" name="nama" placeholder="Nama wilayah / kota (mis. Bandung)" required
               class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
        <button class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-medium">Tambah</button>
    </form>
</div>

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-xs text-gray-500 uppercase border-b bg-gray-50">
                <th class="py-3 px-4">Nama Wilayah</th><th>Jumlah Anggota</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($wilayahs as $w)
            <tr class="border-b">
                <td class="py-3 px-4">{{ $w->nama }}</td>
                <td>{{ $w->jumlah_anggota }} orang</td>
                <td class="px-4">
                    <form action="{{ route('wilayah.destroy', $w) }}" method="POST" onsubmit="return confirm('Hapus wilayah ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center text-gray-400 py-6">Belum ada wilayah. Tambahkan dulu di atas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
