<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->string('bulan'); // format: YYYY-MM
            $table->unsignedInteger('nominal')->default(50000);
            $table->date('tanggal_bayar');
            $table->string('metode')->nullable(); // tunai, transfer, dll
            $table->timestamps();

            $table->unique(['member_id', 'bulan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dues');
    }
};
