<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Kolom id otomatis auto-increment
            $table->string('title'); // Kolom title untuk judul acara
            $table->string('slug')->unique(); // Kolom slug unik untuk URL yang ramah SEO
            $table->text('content'); // Kolom content untuk isi/konten acara
            $table->string('location'); // Kolom location untuk lokasi acara
            $table->date('date'); // Kolom date untuk tanggal acara
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events'); // Menghapus tabel events jika migrasi dibatalkan
    }
}
