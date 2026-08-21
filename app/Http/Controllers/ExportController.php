<?php

namespace App\Http\Controllers;

use App\Exports\DuesExport;
use App\Exports\MembersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function members(Request $request)
    {
        return Excel::download(new MembersExport($request->user()), 'data-anggota-apv.xlsx');
    }

    public function dues(Request $request)
    {
        $bulan = $request->input('bulan');
        $filename = $bulan ? "rekap-iuran-{$bulan}.xlsx" : 'rekap-iuran-semua.xlsx';

        return Excel::download(new DuesExport($request->user(), $bulan), $filename);
    }
}
