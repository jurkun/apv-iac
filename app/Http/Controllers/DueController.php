<?php

namespace App\Http\Controllers;

use App\Models\Due;
use App\Models\Member;
use Illuminate\Http\Request;

class DueController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');

        $query = Due::whereHas('member', function ($q) use ($request) {
            $q->visibleTo($request->user());
        })->with('member');

        if ($bulan) {
            $query->where('bulan', $bulan);
        }

        $dues = $query->orderByDesc('bulan')->paginate(20);

        return view('dues.index', compact('dues', 'bulan'));
    }

    public function create(Request $request)
    {
        $members = Member::visibleTo($request->user())->where('status', 'aktif')->orderBy('nama')->get();
        return view('dues.create', compact('members'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
            'bulan' => ['required', 'date_format:Y-m'],
            'nominal' => ['required', 'integer', 'min:0'],
            'metode' => ['nullable', 'string', 'max:30'],
        ]);

        $member = Member::findOrFail($data['member_id']);
        if ($request->user()->role !== 'admin_pusat' && $member->wilayah !== $request->user()->wilayah) {
            abort(403, 'Anggota tersebut di luar wilayah Anda.');
        }

        $exists = Due::where('member_id', $data['member_id'])->where('bulan', $data['bulan'])->exists();
        if ($exists) {
            return back()->withErrors(['bulan' => 'Iuran bulan ini sudah tercatat lunas untuk anggota tersebut.']);
        }

        $data['tanggal_bayar'] = now()->toDateString();

        Due::create($data);

        return redirect()->route('dues.index')->with('status', 'Iuran berhasil dicatat.');
    }

    public function destroy(Request $request, Due $due)
    {
        $due->load('member');
        if ($request->user()->role !== 'admin_pusat' && $due->member->wilayah !== $request->user()->wilayah) {
            abort(403);
        }
        $due->delete();

        return back()->with('status', 'Catatan iuran dihapus.');
    }
}
