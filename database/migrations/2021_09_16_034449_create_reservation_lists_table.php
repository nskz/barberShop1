<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_lists', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('userId')->nullable();
            $table->string('time')->nullable();
            $table->string('day')->nullable();
            $table->date('date')->nullable();
            $table->integer('barberId')->nullable();
            $table->integer('prePayment')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('reservation_lists');
    }
}
