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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('val');
            $table->timestamps();
        });
        DB::table('subjects')->insert(array('val'=>'mathematics', 'name' => 'Mathematics'));
        DB::table('subjects')->insert(array('val'=>'mathematics-1', 'name' => 'Mathematics 1st Paper'));
        DB::table('subjects')->insert(array('val'=>'mathematics-2', 'name' => 'Mathematics 2nd Paper'));

        DB::table('subjects')->insert(array('val'=>'physics', 'name' => 'Physics'));
        DB::table('subjects')->insert(array('val'=>'physics-1', 'name' => 'Physics 1st Paper'));
        DB::table('subjects')->insert(array('val'=>'physics-2', 'name' => 'Physics 2nd Paper'));

        DB::table('subjects')->insert(array('val'=>'chemistry', 'name' => 'Chemistry'));
        DB::table('subjects')->insert(array('val'=>'chemistry-1', 'name' => 'Chemistry 1st Paper'));
        DB::table('subjects')->insert(array('val'=>'chemistry-2', 'name' => 'Chemistry 2nd Paper'));

        DB::table('subjects')->insert(array('val'=>'biology', 'name' => 'Biology'));
        DB::table('subjects')->insert(array('val'=>'biology-1', 'name' => 'Biology 1st Paper'));
        DB::table('subjects')->insert(array('val'=>'biology-2', 'name' => 'Biology 2nd Paper'));

        DB::table('subjects')->insert(array('val'=>'english', 'name' => 'English'));
        DB::table('subjects')->insert(array('val'=>'general-knowledge', 'name' => 'General Knowledge'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        for ($i = 1; $i<=14;$i++){
            DB::table('subjects')->delete($i);
        }
        Schema::dropIfExists('subjects');
    }
};
