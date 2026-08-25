@extends('layouts.app')

@section('title', 'Pendaftaran Anggota Baru')

@section('content')
<h2 class="text-xl font-semibold mb-4">Pendaftaran Anggota Baru</h2>

@if(session('status'))
    <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded px-4 py-2 mb-4">{{ session('status') }}</div>
@endif
<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-500">
            <tr>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Kontak</th>
                <th class="px-4 py-3">Wilayah</th>
                <th class="px-4 py-3">Kendaraan</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($registrations as $r)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $r->nama }}</td>
                    <td class="px-4 py-3">{{ $r->hp }}<br><span class="text-gray-400">{{ $r->email }}</span></td>
                    <td class="px-4 py-3">{{ $r->wilayah }}</td>
                    <td class="px-4 py-3">{{ $r->tipe_kendaraan }} {{ $r->no_polisi }}</td>
                    <td class="px-4 py-3">
                        @if($r->status === 'menunggu')
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded">Menunggu</span>
                        @elseif($r->status === 'disetujui')
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">Disetujui</span>
                        @else
                            <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $r->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        @if($r->status === 'menunggu')
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('registrations.approve', $r) }}"
                                      onsubmit="return confirm('Setujui pendaftaran ini? Data akan otomatis masuk sebagai Anggota.')">
                                    @csrf
                                    <button class="text-xs bg-[#F0A202] text-[#20242B] font-medium px-3 py-1.5 rounded hover:bg-[#d9910a]">Setujui</button>
                                </form>
                                <form method="POST" action="{{ route('registrations.reject', $r) }}"
                                      onsubmit="return confirm('Tolak pendaftaran ini?')">
                                    @csrf
                                    <button class="text-xs bg-gray-200 text-gray-700 px-3 py-1.5 rounded hover:bg-gray-300">Tolak</button>
                                </form>
                            </div>
                        @else
                            <span class="text-xs text-gray-400">Sudah diproses</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada pendaftaran masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $registrations->links() }}</div>
@endsection
