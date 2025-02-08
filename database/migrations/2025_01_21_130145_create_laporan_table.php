<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('laporan_id'); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key to user
            $table->string('nama_pelapor', 100); // Pelapor name
            $table->string('kontak_pelapor', 15); // Pelapor contact
            $table->text('kronologi'); // Chronology
            $table->string('lokasi_kejadian', 255); // Incident location
            $table->timestamp('tanggal_kejadian'); // Incident date
            $table->text('bukti_kejadian')->nullable(); // Incident evidence (nullable)
            $table->enum('status', ['Di Proses', 'Selesai'])->default('Di Proses'); // Report status
            $table->timestamps(); 
            // Foreign Key Constraint
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
