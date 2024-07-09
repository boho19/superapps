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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 17)->unique();
            $table->string('nama', 50);
            $table->enum('jenis_kelamin', ['LK', 'PR']);
            $table->enum('cabang', ['jambi alam barajo', 'jambi jelutung', 'jambi sortation'])->nullable();
            $table->string('no_hp', 18);
            $table->string('alamat', 150)->nullable();
            $table->string('provinsi', 25)->nullable();
            $table->string('jabatan', 20)->nullable();
            $table->string('foto', 100)->default('profile.png');
            $table->foreignId('id_user')->constrained(table:'users', indexName:'karyawans_id_user');
            $table->enum('status', ['aktif', 'cuti', 'sakit', 'keluar'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
