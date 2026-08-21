@extends('layouts.app')
@section('title', 'Anggota')

@section('content')
<div class="flex justify-between items-center mb-4 flex-wrap gap-3">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / wilayah..."
               class="border border-gray-300 rounded px-3 py-2 text-sm w-64">
        <button class="border border-gray-300 rounded px-3 py-2 text-sm bg-white">Cari</button>
    </form>
    <div class="flex gap-2">
        <a href="{{ route('export.members') }}" class="border border-gray-300 bg-white rounded px-3 py-2 text-sm">Export Excel</a>
        <a href="{{ route('members.create') }}" class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-medium">+ Tambah anggota</a>
    </div>
</div>

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-xs text-gray-500 uppercase border-b bg-gray-50">
                <th class="py-3 px-4">ID</th><th>Nama</th><th>Wilayah</th><th>No. HP</th><th>Kendaraan</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $m)
            <tr class="border-b">
                <td class="py-3 px-4"><span class="bg-[#F0A202] text-[#20242B] font-mono font-bold text-xs px-2 py-1 rounded">{{ $m->kode_anggota ?? '-' }}</span></td>
                <td class="py-3 px-4">{{ $m->nama }}</td>
                <td><span class="bg-indigo-50 text-indigo-700 text-xs px-2 py-1 rounded">{{ $m->wilayah }}</span></td>
                <td>{{ $m->hp ?? '-' }}</td>
                <td>{{ $m->vehicles_count }} unit</td>
                <td>
                    <span class="text-xs px-2 py-1 rounded {{ $m->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($m->status) }}
                    </span>
                </td>
                <td class="px-4">
                    <a href="{{ route('members.edit', $m) }}" class="text-blue-600 text-xs mr-2">Edit</a>
                    <form action="{{ route('members.destroy', $m) }}" method="POST" class="inline" onsubmit="return confirm('Hapus anggota ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-gray-400 py-6">Belum ada anggota.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $members->links() }}</div>
@endsection
