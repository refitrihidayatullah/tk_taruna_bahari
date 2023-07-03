<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sambutan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_sambutan');
            $table->string('judul_sambutan');
            $table->longText('isi_sambutan');
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
        Schema::dropIfExists('tb_sambutan');
    }
};
