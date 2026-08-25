<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::urut()->get();

        return view('activities.index', compact('activities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:30'],
            'judul' => ['required', 'string', 'max:80'],
            'deskripsi' => ['required', 'string', 'max:300'],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ]);

        Activity::create($data);

        return back()->with('status', 'Kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:30'],
            'judul' => ['required', 'string', 'max:80'],
            'deskripsi' => ['required', 'string', 'max:300'],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ]);

        $activity->update($data);

        return back()->with('status', 'Kegiatan diperbarui.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return back()->with('status', 'Kegiatan dihapus.');
    }
}
