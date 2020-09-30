<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefectiveProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defective_products', function (Blueprint $table) {
            $table->id();
            $table->integer('products_id')->unsigned();
            $table->string('image')->nullable();
            $table->string('name');
            $table->float('retail' ,8, 2);
            $table->float('wholesale' ,8, 2);
            $table->integer('qty')->nullable();
            $table->integer('branch_id')->unsigned();
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
        Schema::dropIfExists('defective_products');
    }
}
