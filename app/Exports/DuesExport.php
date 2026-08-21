<?php

namespace App\Exports;

use App\Models\Due;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DuesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $user;
    protected $bulan;

    public function __construct($user, $bulan = null)
    {
        $this->user = $user;
        $this->bulan = $bulan;
    }

    public function collection()
    {
        $query = Due::whereHas('member', fn($q) => $q->visibleTo($this->user))->with('member');

        if ($this->bulan) {
            $query->where('bulan', $this->bulan);
        }

        return $query->orderByDesc('bulan')->get();
    }

    public function headings(): array
    {
        return ['Nama anggota', 'Wilayah', 'Bulan', 'Nominal (Rp)', 'Tanggal bayar', 'Metode'];
    }

    public function map($due): array
    {
        return [
            $due->member->nama,
            $due->member->wilayah,
            $due->bulan,
            $due->nominal,
            optional($due->tanggal_bayar)->format('d-m-Y'),
            $due->metode,
        ];
    }
}
