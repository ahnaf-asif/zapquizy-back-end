<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_test_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->string('cover_image');
            $table->boolean('status')->default(false);

            $table->bigInteger('level_id');
            $table->bigInteger('subject_id');

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
        Schema::dropIfExists('model_test_packages');
    }
};
