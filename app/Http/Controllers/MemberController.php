<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::visibleTo($request->user());

        if ($q = $request->input('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('wilayah', 'like', "%{$q}%");
            });
        }

        $members = $query->withCount('vehicles')->orderByDesc('created_at')->paginate(20);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        $suggestedCode = Member::generateNextCode();
        $wilayahs = Wilayah::orderBy('nama')->get();
        return view('members.create', compact('suggestedCode', 'wilayahs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_anggota' => ['nullable', 'string', 'max:20', 'unique:members,kode_anggota'],
            'nama' => ['required', 'string', 'max:150'],
            'hp' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'wilayah' => ['required', 'string', 'max:100'],
            'alamat' => ['nullable', 'string'],
            'tanggal_gabung' => ['nullable', 'date'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'foto_ktp' => ['nullable', 'image', 'max:2048'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        if (empty($data['kode_anggota'])) {
            $data['kode_anggota'] = Member::generateNextCode();
        }

        if ($request->user()->role !== 'admin_pusat') {
            $data['wilayah'] = $request->user()->wilayah;
        }

        if ($request->hasFile('foto_ktp')) {
            $data['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-anggota', 'public');
        }

        Member::create($data);

        return redirect()->route('members.index')->with('status', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Member $member)
    {
        $this->authorizeWilayah($member);
        $wilayahs = Wilayah::orderBy('nama')->get();
        return view('members.edit', compact('member', 'wilayahs'));
    }

    public function update(Request $request, Member $member)
    {
        $this->authorizeWilayah($member);

        $data = $request->validate([
            'kode_anggota' => ['nullable', 'string', 'max:20', 'unique:members,kode_anggota,' . $member->id],
            'nama' => ['required', 'string', 'max:150'],
            'hp' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'wilayah' => ['required', 'string', 'max:100'],
            'alamat' => ['nullable', 'string'],
            'tanggal_gabung' => ['nullable', 'date'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'foto_ktp' => ['nullable', 'image', 'max:2048'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto_ktp')) {
            if ($member->foto_ktp) {
                Storage::disk('public')->delete($member->foto_ktp);
            }
            $data['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        }

        if ($request->hasFile('foto')) {
            if ($member->foto) {
                Storage::disk('public')->delete($member->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-anggota', 'public');
        }

        $member->update($data);

        return redirect()->route('members.index')->with('status', 'Data anggota diperbarui.');
    }

    public function destroy(Request $request, Member $member)
    {
        $this->authorizeWilayah($member);
        $member->delete();

        return back()->with('status', 'Anggota dihapus.');
    }

    public function card(Member $member)
    {
        $this->authorizeWilayah($member);
        return view('members.card', compact('member'));
    }

    private function authorizeWilayah(Member $member)
    {
        $user = request()->user();
        if ($user->role !== 'admin_pusat' && $member->wilayah !== $user->wilayah) {
            abort(403, 'Anda tidak bisa mengelola anggota di luar wilayah Anda.');
        }
    }
}
