<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MembersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function collection()
    {
        return Member::visibleTo($this->user)->orderBy('wilayah')->orderBy('nama')->get();
    }

    public function headings(): array
    {
        return ['ID Anggota', 'Nama', 'Wilayah', 'No. HP', 'Email', 'Alamat', 'Tanggal gabung', 'Status', 'Jumlah kendaraan'];
    }

    public function map($member): array
    {
        return [
            $member->kode_anggota,
            $member->nama,
            $member->wilayah,
            $member->hp,
            $member->email,
            $member->alamat,
            optional($member->tanggal_gabung)->format('d-m-Y'),
            ucfirst($member->status),
            $member->vehicles()->count(),
        ];
    }
}
