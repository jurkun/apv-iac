<?php

namespace App\Http\Controllers;

use App\Models\Due;
use App\Models\Member;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $bulanIni = now()->format('Y-m');

        $totalAnggota = Member::visibleTo($user)->count();
        $anggotaAktif = Member::visibleTo($user)->where('status', 'aktif')->count();
        $totalKendaraan = Vehicle::whereHas('member', fn($q) => $q->visibleTo($user))->count();

        $sudahBayarIds = Due::where('bulan', $bulanIni)
            ->whereHas('member', fn($q) => $q->visibleTo($user))
            ->pluck('member_id');

        $belumBayar = Member::visibleTo($user)
            ->where('status', 'aktif')
            ->whereNotIn('id', $sudahBayarIds)
            ->get();

        // data grafik: total iuran per wilayah untuk bulan berjalan
        $grafikWilayah = Due::where('bulan', $bulanIni)
            ->whereHas('member', fn($q) => $q->visibleTo($user))
            ->join('members', 'dues.member_id', '=', 'members.id')
            ->selectRaw('members.wilayah as wilayah, SUM(dues.nominal) as total')
            ->groupBy('members.wilayah')
            ->orderByDesc('total')
            ->get();

        $anggotaTerbaru = Member::visibleTo($user)->orderByDesc('created_at')->limit(5)->get();

        return view('dashboard.index', compact(
            'totalAnggota', 'anggotaAktif', 'totalKendaraan',
            'belumBayar', 'grafikWilayah', 'anggotaTerbaru', 'bulanIni'
        ));
    }
}
