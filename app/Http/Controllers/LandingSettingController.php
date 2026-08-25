<?php

namespace App\Http\Controllers;

use App\Models\LandingSetting;
use Illuminate\Http\Request;

class LandingSettingController extends Controller
{
    public function edit()
    {
        $settings = LandingSetting::allCached();

        return view('gallery.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_title_1' => ['required', 'string', 'max:60'],
            'hero_title_2' => ['required', 'string', 'max:60'],
            'hero_title_3' => ['required', 'string', 'max:60'],
            'hero_lede' => ['required', 'string', 'max:500'],
            'tahun_berdiri' => ['required', 'string', 'max:10'],
            'ig_url' => ['nullable', 'string', 'max:255'],
            'wa_url' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($data as $key => $value) {
            LandingSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        LandingSetting::forgetCache();

        return back()->with('status', 'Pengaturan landing page diperbarui.');
    }
}
