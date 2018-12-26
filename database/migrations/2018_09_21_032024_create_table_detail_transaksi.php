<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaksi_id')->unsigned();
            $table->integer('jadwal_id')->nullable()->unsigned();
            $table->integer('non_sewa_id')->nullable()->unsigned();
            $table->integer('harga')->default(0);
            $table->integer('jumlah')->default(0);
            $table->integer('status')->default(0);
            $table->date('tanggal_booking')->nullable();

            $table->foreign('transaksi_id')->references('id')->on('transaksi');
            $table->foreign('jadwal_id')->references('id')->on('jadwal');
            $table->foreign('non_sewa_id')->references('id')->on('non_sewa');
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
        Schema::dropIfExists('detail_transaksi');
    }
}
