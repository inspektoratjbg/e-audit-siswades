<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRingkasanKeuanganDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ringkasan_keuangan_desa', function (Blueprint $table) {
            $table->char('kd_desa', 10);
            $table->integer('tahun');
            $table->string('label_a')->nullable();
            $table->string('label_b')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ringkasan_keuangan_desa');
    }
}
