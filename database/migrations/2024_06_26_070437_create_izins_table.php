<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_karyawan')->constrained(table:'karyawans', indexName:'izins_id_karyawan');
            $table->enum('keterangan', ['sakit', 'cuti']);
            $table->string('alasan', 150);
            $table->date('mulai');
            $table->date('selesai');
            $table->enum('status', ['disetujui', 'tertunda', 'ditolak'])->default('tertunda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izins');
    }
};
