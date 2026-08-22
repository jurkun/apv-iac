<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Anggota — {{ $member->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none !important; }
            .card { box-shadow: none !important; }
        }
        body { font-family: 'Segoe UI', sans-serif; }
    </style>
</head>
<body class="bg-gray-200 min-h-screen flex flex-col items-center justify-center gap-4 p-6">

    <div class="no-print flex gap-2">
        <button onclick="window.print()" class="bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-semibold">Cetak Kartu</button>
        <a href="{{ route('members.index') }}" class="bg-white border border-gray-300 rounded px-4 py-2 text-sm">Kembali</a>
    </div>

    <!-- Kartu member: ukuran mirip KTP/ID card, 340x214px (rasio kartu standar) -->
    <div class="card relative w-[420px] h-[264px] rounded-2xl overflow-hidden shadow-xl"
         style="background: linear-gradient(135deg, #20242B 0%, #2B303A 60%, #20242B 100%);">

        <!-- watermark logo/mobil transparan di background -->
        <img src="{{ asset('images/logo-apv-iac.jpeg') }}"
             class="absolute -right-10 -bottom-10 w-56 h-56 object-cover opacity-10 rounded-full">

        <!-- strip kuning atas -->
        <div class="absolute top-0 left-0 right-0 h-2 bg-[#F0A202]"></div>

        <div class="relative z-10 flex h-full">
            <!-- kolom kiri: foto -->
            <div class="w-28 flex flex-col items-center justify-center pl-4 py-4">
                <div class="w-20 h-24 rounded-lg overflow-hidden border-2 border-[#F0A202] bg-gray-700 flex items-center justify-center">
                    @if($member->foto)
                        <img src="{{ asset('storage/' . $member->foto) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-400 text-3xl">👤</span>
                    @endif
                </div>
                <span class="mt-2 text-[10px] px-2 py-0.5 rounded-full {{ $member->status === 'aktif' ? 'bg-green-500' : 'bg-red-500' }} text-white font-semibold uppercase tracking-wide">
                    {{ $member->status }}
                </span>
            </div>

            <!-- kolom kanan: info -->
            <div class="flex-1 py-4 pr-4 flex flex-col justify-between text-white">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <img src="{{ asset('images/logo-apv-iac.jpeg') }}" class="w-8 h-8 rounded object-cover border border-[#F0A202]">
                        <div class="leading-tight">
                            <p class="text-[9px] text-gray-300 uppercase tracking-wider">Kartu Tanda Anggota</p>
                            <p class="text-xs font-bold text-[#F0A202]">APV - IAC SABILULUNGAN</p>
                        </div>
                    </div>

                    <p class="text-lg font-bold leading-tight mt-3">{{ $member->nama }}</p>
                    <p class="text-[11px] text-gray-300">{{ $member->wilayah }}</p>
                </div>

                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-[9px] text-gray-400 uppercase">No. Anggota</p>
                        <p class="font-mono font-bold text-[#F0A202] text-sm tracking-wider">{{ $member->kode_anggota }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] text-gray-400 uppercase">Bergabung</p>
                        <p class="text-[10px] text-gray-200">{{ optional($member->tanggal_gabung)->format('m/Y') ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- strip kuning bawah -->
        <div class="absolute bottom-0 left-0 right-0 h-2 bg-[#F0A202]"></div>
    </div>

    <p class="no-print text-xs text-gray-500">Ukuran kartu: 420×264px (proporsi kartu ID standar)</p>

</body>
</html>
