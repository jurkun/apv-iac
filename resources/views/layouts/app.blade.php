<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APV - IAC SABILULUNGAN — @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#F3F1E9] text-[#20242B]">

<div class="bg-[#20242B] text-[#F3F1E9] px-6 py-4 flex items-center justify-between flex-wrap gap-3">
    <div class="flex items-center gap-3">
        <img src="{{ asset('images/logo-apv-iac.jpeg') }}" alt="APV IAC Sabilulungan" class="h-10 w-10 rounded object-cover border-2 border-[#F0A202]">
        <div>
            <h1 class="font-semibold text-lg">APV - IAC SABILULUNGAN</h1>
            @auth
            <p class="text-xs text-gray-300">
                <a href="{{ route('profile.edit') }}" class="hover:text-[#F0A202] hover:underline">{{ auth()->user()->name }}</a>
                — {{ auth()->user()->role === 'admin_pusat' ? 'Admin pusat' : 'Pengurus ' . auth()->user()->wilayah }}
            </p>
            @endauth
        </div>
    </div>
    @auth
    <nav class="flex gap-1 bg-[#2B303A] p-1 rounded-lg text-sm overflow-x-auto max-w-full">
        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Dashboard</a>
        <a href="{{ route('members.index') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Anggota</a>
        <a href="{{ route('vehicles.index') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Kendaraan</a>
        <a href="{{ route('dues.index') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Iuran</a>
        <a href="{{ route('gallery.index') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Galeri</a>
        <a href="{{ route('activities.index') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Kegiatan</a>
        <a href="{{ route('organizers.index') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Pengurus</a>
        <a href="{{ route('sponsors.index') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Sponsor</a>
        <a href="{{ route('registrations.index') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Pendaftaran</a>
        <a href="{{ route('landing-settings.edit') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Landing Page</a>
        @if(auth()->user()->role === 'admin_pusat')
        <a href="{{ route('wilayah.index') }}" class="px-3 py-2 rounded-md hover:bg-[#F0A202] hover:text-[#20242B] whitespace-nowrap">Wilayah</a>
        @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-3 py-2 rounded-md hover:bg-[#D64545] hover:text-white whitespace-nowrap">Keluar</button>
        </form>
    </nav>
    @endauth
</div>

<main class="max-w-5xl mx-auto p-6">
    @if (session('status'))
        <div class="bg-green-100 text-green-800 text-sm px-4 py-2 rounded mb-4">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 text-sm px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

</body>
</html>
