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
        Schema::table('tb_profile_sekolah', function (Blueprint $table) {
            $table->string('email_sekolah')->after('nama_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_profile_sekolah', function (Blueprint $table) {
            $table->dropColumn('email_sekolah');
        });
    }
};
