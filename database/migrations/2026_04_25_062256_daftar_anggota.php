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
        Schema::create('daftar_anggota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');

            // Data dari Tabel
            $table->string('no_registrasi')->nullable();
            $table->string('name');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();

            // KOLOM BARU: Status di Kepengurusan
            // Sekretaris (Wakil Sekretaris/Bendahara) atau Pokja 1-4
            $table->enum('role_pkk', [
                'Ketua',
                'Wakil',
                'Bendahara',
                'Sekretaris',
                'Pokja 1',
                'Pokja 2',
                'Pokja 3',
                'Pokja 4',
                'Anggota'
            ])->default('Anggota');

            // Kedudukan/Fungsi
            $table->string('keanggotaan_tp_pkk')->nullable();
            $table->boolean('kader_umum')->default(false);
            $table->boolean('kader_khusus')->default(false);

            // Data Pribadi Lainnya
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('umur')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->text('keterangan')->nullable();

            // Foto (karena di gambar ada foto anggota)
            $table->string('foto')->nullable();

            // Metadata & Foreign Key
            $table->string('email')->unique()->nullable();
            $table->string('notelp')->unique()->nullable();
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_anggota');
    }
};
