<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',1000);

            $table->string('var_name',15);

            $table->string('slug',250)->unique();

            $table->string('type',25);
            $table->string('unit',50);
            $table->integer('attr_group');

            $table->string('content',1000)->nullable();
            $table->text('description')->nullable();

            $table->integer('order');

            $table->integer('status');

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
        Schema::dropIfExists('attribute');
    }
}
