<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salers', function (Blueprint $table) {
            $table->id();
            // $table->integer('order_lists_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            // $table->integer('qty')->nullable();
            $table->integer('total')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('Total_price')->nullable();
            $table->integer('change')->nullable();
            $table->integer('cash')->nullable();
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
        Schema::dropIfExists('salers');
    }
}
