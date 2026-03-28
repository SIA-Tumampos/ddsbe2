<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAllTables extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('usersjob')) {
            Schema::create('usersjob', function (Blueprint $table) {
                $table->bigIncrements('jobid');
                $table->string('jobname', 250);
            });
        }

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->bigInteger('jobid')->unsigned()->nullable();
                $table->string('username', 50)->nullable();
                $table->string('password', 20)->nullable();
                $table->foreign('jobid')->references('jobid')->on('usersjob')->onDelete('cascade');
            });
        }

        // Insert data only if empty
        if (DB::table('usersjob')->count() === 0) {
            DB::table('usersjob')->insert([
                ['jobid' => 7, 'jobname' => 'Plumber'],
                ['jobid' => 8, 'jobname' => 'Computer Scientist'],
                ['jobid' => 9, 'jobname' => 'Mathematician'],
                ['jobid' => 10, 'jobname' => 'Remotaskers'],
            ]);
        }

        if (DB::table('users')->count() === 0) {
            DB::table('users')->insert([
                ['id' => 1, 'jobid' => 7, 'username' => 'Aronn', 'password' => '1234'],
                ['id' => 2, 'jobid' => 8, 'username' => 'John', 'password' => '1234'],
                ['id' => 3, 'jobid' => 9, 'username' => 'Antone', 'password' => '1234'],
                ['id' => 4, 'jobid' => 10, 'username' => 'Tumampos', 'password' => '1234'],
                ['id' => 6, 'jobid' => null, 'username' => 'Bruh', 'password' => '4444444'],
                ['id' => 7, 'jobid' => null, 'username' => 'Bruh2', 'password' => '4444444'],
                ['id' => 8, 'jobid' => 7, 'username' => 'Bruh22', 'password' => '4444444'],
            ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('usersjob');
    }
}