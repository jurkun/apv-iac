<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // contoh: KOPDAR, TOURING
            $table->string('judul');
            $table->text('deskripsi');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Isi data awal dari konten yang sebelumnya hardcode
        $defaults = [
            ['label' => 'KOPDAR', 'judul' => 'Kopi Darat Rutin', 'deskripsi' => 'Pertemuan bulanan untuk mempererat silaturahmi antar anggota dan keluarga.', 'urutan' => 1],
            ['label' => 'TOURING', 'judul' => 'Konvoi & Wisata', 'deskripsi' => 'Perjalanan bersama ke destinasi wisata Jawa Barat dan sekitarnya, lengkap dengan pengawalan.', 'urutan' => 2],
            ['label' => 'TEKNIS', 'judul' => 'Sharing Perawatan', 'deskripsi' => 'Diskusi dan pelatihan perawatan dasar APV bersama anggota yang berpengalaman.', 'urutan' => 3],
            ['label' => 'SOSIAL', 'judul' => 'Bakti Sosial', 'deskripsi' => 'Aksi donasi dan bantuan bagi masyarakat sekitar, terutama saat momen bencana atau hari besar.', 'urutan' => 4],
            ['label' => 'MERCHANDISE', 'judul' => 'Atribut Komunitas', 'deskripsi' => 'Kaos, stiker, dan emblem resmi sebagai identitas kebanggaan anggota Sabilulungan.', 'urutan' => 5],
            ['label' => 'ANNIVERSARY', 'judul' => 'Milad Tahunan', 'deskripsi' => 'Perayaan ulang tahun komunitas dengan gathering akbar seluruh chapter.', 'urutan' => 6],
        ];

        foreach ($defaults as $item) {
            DB::table('activities')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
