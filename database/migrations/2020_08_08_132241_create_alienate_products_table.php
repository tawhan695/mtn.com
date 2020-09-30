<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlienateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alienate_products', function (Blueprint $table) {
            $table->id();
            $table->integer('products_id')->unsigned();
            $table->boolean('status')->default(false);
            $table->string('image')->nullable();
            $table->string('name');
            $table->float('retail' ,8, 2);
            $table->float('wholesale' ,8, 2);
            $table->integer('qty')->nullable();
            $table->string('form')->nullable();
            $table->integer('branch_id')->unsigned();
            $table->timestamp('sent_date',0);
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
        Schema::dropIfExists('alienate_products');
    }
}
