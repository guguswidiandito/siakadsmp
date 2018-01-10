<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->string('nis');
            $table->string('nama');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->integer('tahun_masuk')->unsigned();
            $table->integer('kelas_id')->unsigned();
            $table->timestamps();

            $table->primary('nis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
