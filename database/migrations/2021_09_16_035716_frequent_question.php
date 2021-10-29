<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FrequentQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequent_question', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->mediumText('question')->nullable();
            $table->mediumText('answer')->nullable();
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
        //
    }
}
