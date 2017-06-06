<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->tinyInteger('state');
            $table->float('price');
            $table->text('description');
            $table->text('size', ['L', 'M', 'S', 'XL', 'XXL', 'XXXL']);
            $table->enum('color', ['white', 'dark', 'blue', 'red', 'green', 'yellow', 'pink', 'khaki']);
            $table->integer('length');
            $table->integer('chest');
            $table->integer('shoulders');
            $table->enum('season', ['summer', 'autumn', 'winter', 'spring']);
            $table->enum('sleeve', ['long', 'short']);
            $table->enum('composition', ['cotton', 'cotton/polyester']);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
