<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        $defaults = [
            'hero_title_1' => 'Satu Jalur,',
            'hero_title_2' => 'Sejuta Kilometer',
            'hero_title_3' => 'Kebersamaan.',
            'hero_lede' => 'APV IAC Sabilulungan adalah rumah bagi para pemilik dan pecinta Suzuki APV di tanah Sunda — tempat konvoi, silaturahmi, dan gotong royong berjalan beriringan di setiap perjalanan.',
            'tahun_berdiri' => '2012',
            'ig_url' => '#',
            'wa_url' => '#',
            'email' => 'apviacsabilulungan@gmail.com',
        ];

        foreach ($defaults as $key => $value) {
            DB::table('landing_settings')->insert([
                'key' => $key,
                'value' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_settings');
    }
};
