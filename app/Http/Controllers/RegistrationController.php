<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'hp' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'wilayah' => ['required', 'string', 'max:100'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'tipe_kendaraan' => ['nullable', 'string', 'max:100'],
            'no_polisi' => ['nullable', 'string', 'max:20'],
        ]);

        $data['status'] = 'menunggu';

        Registration::create($data);

        return back()->with('status', 'Pendaftaran Kamu berhasil dikirim! Tim kami akan meninjau dan menghubungi Kamu segera.');
    }
}
