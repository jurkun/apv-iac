<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::whereHas('member', function ($q) use ($request) {
            $q->visibleTo($request->user());
        })->with('member')->orderByDesc('created_at')->paginate(20);

        return view('vehicles.index', compact('vehicles'));
    }

    public function create(Request $request)
    {
        $members = Member::visibleTo($request->user())->orderBy('nama')->get();
        return view('vehicles.create', compact('members'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
            'plat_nomor' => ['required', 'string', 'max:20', 'unique:vehicles,plat_nomor'],
            'tipe' => ['nullable', 'string', 'max:100'],
            'tahun' => ['nullable', 'integer', 'min:1990', 'max:' . (date('Y') + 1)],
            'warna' => ['nullable', 'string', 'max:50'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $member = Member::findOrFail($data['member_id']);
        if ($request->user()->role !== 'admin_pusat' && $member->wilayah !== $request->user()->wilayah) {
            abort(403, 'Anggota tersebut di luar wilayah Anda.');
        }

        $data['plat_nomor'] = strtoupper($data['plat_nomor']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
        }

        Vehicle::create($data);

        return redirect()->route('vehicles.index')->with('status', 'Kendaraan berhasil ditambahkan.');
    }

    public function destroy(Request $request, Vehicle $vehicle)
    {
        $vehicle->load('member');
        if ($request->user()->role !== 'admin_pusat' && $vehicle->member->wilayah !== $request->user()->wilayah) {
            abort(403);
        }
        $vehicle->delete();

        return back()->with('status', 'Kendaraan dihapus.');
    }
}
