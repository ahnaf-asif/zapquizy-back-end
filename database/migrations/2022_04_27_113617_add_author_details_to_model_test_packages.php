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
        Schema::table('model_test_packages', function (Blueprint $table) {
            $table->string('author_name')->nullable();
            $table->string('author_designation')->nullable();
            $table->string('author_picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model_test_packages', function (Blueprint $table) {
            $table->dropColumn('author_name');
            $table->dropColumn('author_designation');
            $table->dropColumn('author_picture');
        });
    }
};
