<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTintucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tintucs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TieuDe', 255)->nullable();
            $table->string('TieuDeKhongDau', 255)->nullable();
            $table->longText('NoiDung')->nullable();
            $table->string('Hinh')->nullable();
            $table->integer('NoiBat')->default(0)->nullable();
            $table->integer('SoLuotXem')->default(0)->nullable();
            $table->integer('idTheLoai')->unsigned()->nullable();
            $table->foreign('idTheLoai')->references('id')->on('theloais')->onDelete('cascade');
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
        Schema::dropIfExists('tintucs');
    }
}
