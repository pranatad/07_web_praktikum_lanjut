<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahTabelMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function($table) {
            $table->string('email', 35);
            $table->string('alamat', 35);
            $table->string('tanggallahir', 35);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa', function($table) {
        $table->dropColumn('email');
        $table->dropColumn('alamat');
        $table->dropColumn('tanggallahir');
        });
    }
}
