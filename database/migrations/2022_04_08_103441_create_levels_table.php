<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('val');
            $table->timestamps();
        });
        DB::table('levels')->insert(array('val'=>'ssc', 'name' => 'SSC'));
        DB::table('levels')->insert(array('val'=>'hsc', 'name' => 'HSC'));
        DB::table('levels')->insert(array('val'=>'ndc', 'name' => 'NDC Admission'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('levels')->delete(1);
        DB::table('levels')->delete(2);
        DB::table('levels')->delete(3);
        Schema::dropIfExists('levels');
    }
};
