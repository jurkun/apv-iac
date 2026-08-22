<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — APV - IAC SABILULUNGAN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F3F1E9] text-[#20242B] min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-sm">
    <div class="flex flex-col items-center gap-2 justify-center mb-6">
         <img src="{{ asset('images/logo-apv-iac.jpeg') }}" alt="APV IAC Sabilulungan" class="h-24 w-24 rounded-lg object-cover border-2 border-[#F0A202]">
        <h1 class="font-semibold text-lg">APV - IAC SABILULUNGAN</h1>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h2 class="font-semibold mb-4 text-center">Masuk ke akun kamu</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 text-sm px-4 py-2 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('status'))
            <div class="bg-green-100 text-green-800 text-sm px-4 py-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm block mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Lupa password?</a>
                @endif
            </div>
            <button type="submit" class="w-full bg-[#F0A202] text-[#20242B] rounded px-4 py-2 text-sm font-semibold">
                Masuk
            </button>
        </form>
    </div>
</div>

</body>
</html>
