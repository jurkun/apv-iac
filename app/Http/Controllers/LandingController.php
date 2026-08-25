<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\GalleryPhoto;
use App\Models\LandingSetting;
use App\Models\Member;
use App\Models\Sponsor;

class LandingController extends Controller
{
    public function index()
    {
        $settings = LandingSetting::allCached();

        $photos = GalleryPhoto::urut()->get();
        $activities = Activity::urut()->get();
        $sponsors = Sponsor::urut()->get();

        $jumlahAnggota = Member::where('status', 'aktif')->count();
        $jumlahWilayah = Member::whereNotNull('wilayah')->distinct('wilayah')->count('wilayah');

        return view('landing.index', compact('settings', 'photos', 'activities', 'sponsors', 'jumlahAnggota', 'jumlahWilayah'));
    }
}
