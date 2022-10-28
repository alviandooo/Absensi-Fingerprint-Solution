<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_absensi', function (Blueprint $table) {
            $table->id();
            $table->integer("uid");
            $table->string("nik");
            $table->string("state");
            $table->date("tanggal");
            $table->time("waktu");
            // tipe absensi : masuk / keluar
            $table->string("type");
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
        Schema::dropIfExists('log_absensi');
    }
}
