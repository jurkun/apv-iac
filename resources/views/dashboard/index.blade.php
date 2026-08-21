@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-200 border-l-4 border-l-[#F0A202] rounded-lg p-4">
        <div class="text-2xl font-semibold">{{ $totalAnggota }}</div>
        <div class="text-xs text-gray-500 uppercase">Total anggota</div>
    </div>
    <div class="bg-white border border-gray-200 border-l-4 border-l-[#3E8F5B] rounded-lg p-4">
        <div class="text-2xl font-semibold">{{ $anggotaAktif }}</div>
        <div class="text-xs text-gray-500 uppercase">Anggota aktif</div>
    </div>
    <div class="bg-white border border-gray-200 border-l-4 border-l-[#F0A202] rounded-lg p-4">
        <div class="text-2xl font-semibold">{{ $totalKendaraan }}</div>
        <div class="text-xs text-gray-500 uppercase">Kendaraan</div>
    </div>
    <div class="bg-white border border-gray-200 border-l-4 border-l-[#D64545] rounded-lg p-4">
        <div class="text-2xl font-semibold">{{ $belumBayar->count() }}</div>
        <div class="text-xs text-gray-500 uppercase">Belum bayar ({{ $bulanIni }})</div>
    </div>
</div>

<div class="bg-white border border-gray-200 rounded-lg p-5 mb-6">
    <h2 class="font-semibold mb-3">Iuran per wilayah — {{ $bulanIni }}</h2>
    <canvas id="chartWilayah" height="90"></canvas>
</div>

<div class="bg-white border border-gray-200 rounded-lg p-5 mb-6">
    <h2 class="font-semibold mb-3">Tunggakan bulan ini</h2>
    @if($belumBayar->isEmpty())
        <p class="text-sm text-gray-500">Semua anggota aktif sudah bayar bulan ini.</p>
    @else
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-gray-500 uppercase border-b">
                    <th class="py-2">Nama</th><th>Wilayah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($belumBayar as $m)
                <tr class="border-b">
                    <td class="py-2">{{ $m->nama }}</td>
                    <td><span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded">{{ $m->wilayah }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="bg-white border border-gray-200 rounded-lg p-5">
    <h2 class="font-semibold mb-3">Anggota terbaru</h2>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-xs text-gray-500 uppercase border-b">
                <th class="py-2">Nama</th><th>Wilayah</th><th>Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggotaTerbaru as $m)
            <tr class="border-b">
                <td class="py-2">{{ $m->nama }}</td>
                <td>{{ $m->wilayah }}</td>
                <td>{{ optional($m->tanggal_gabung)->format('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center text-gray-400 py-4">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
const ctx = document.getElementById('chartWilayah');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($grafikWilayah->pluck('wilayah')) !!},
        datasets: [{
            label: 'Total iuran (Rp)',
            data: {!! json_encode($grafikWilayah->pluck('total')) !!},
            backgroundColor: '#F0A202',
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endsection
