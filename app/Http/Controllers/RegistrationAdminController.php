<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::query();

        if ($request->user()->role !== 'admin_pusat') {
            $query->where('wilayah', $request->user()->wilayah);
        }

        $registrations = $query->orderByRaw("status = 'menunggu' desc")
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('registrations.index', compact('registrations'));
    }

    public function approve(Request $request, Registration $registration)
    {
        $this->authorizeWilayah($registration);

        if ($registration->status !== 'menunggu') {
            return back()->with('status', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        $member = Member::create([
            'kode_anggota' => Member::generateNextCode(),
            'nama' => $registration->nama,
            'hp' => $registration->hp,
            'email' => $registration->email,
            'wilayah' => $registration->wilayah,
            'alamat' => $registration->alamat,
            'tanggal_gabung' => now(),
            'status' => 'aktif',
        ]);

        $registration->update([
            'status' => 'disetujui',
            'member_id' => $member->id,
        ]);

        return back()->with('status', 'Pendaftaran disetujui, anggota baru berhasil ditambahkan.');
    }

    public function reject(Request $request, Registration $registration)
    {
        $this->authorizeWilayah($registration);

        $data = $request->validate([
            'catatan_admin' => ['nullable', 'string', 'max:255'],
        ]);

        if ($registration->status !== 'menunggu') {
            return back()->with('status', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        $registration->update([
            'status' => 'ditolak',
            'catatan_admin' => $data['catatan_admin'] ?? null,
        ]);

        return back()->with('status', 'Pendaftaran ditolak.');
    }

    private function authorizeWilayah(Registration $registration)
    {
        $user = request()->user();
        if ($user->role !== 'admin_pusat' && $registration->wilayah !== $user->wilayah) {
            abort(403, 'Anda tidak bisa memproses pendaftaran di luar wilayah Anda.');
        }
    }
}
