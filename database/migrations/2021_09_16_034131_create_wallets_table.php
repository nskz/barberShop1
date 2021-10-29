<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('userId')->nullable();
            $table->integer('reservationId')->nullable();
            $table->string('description')->nullable();
            $table->string('trackingCode')->nullable();
            $table->integer('price')->nullable();
            $table->integer('cash')->nullable();
            $table->integer('typeId')->nullable()->comment('0:withdraw,1:deposit');
            $table->integer('status')->nullable()->comment('0:unsuccess,1:success');
            $table->integer('reasonId')->nullable();
            $table->integer('barberShopId')->nullable()->default(1);
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
        Schema::dropIfExists('wallets');
    }
}
