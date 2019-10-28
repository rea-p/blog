<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid')->default(1);
            // $table->integer('id_dep')->default(0);
            $table->string('name');
            $table->string('email');
            $table->string('photo')->default ('/uploads/images/default.png');
            $table->string('password');
            $table->tinyInteger('role')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table -> integer('dep_id') -> unsigned();
            $table -> foreign('dep_id') -> references('id') -> on('department');
            // $table->integer('dep_id')->unsigned()->index()->nullable();
            // $table->foreign('dep_id')->references('id_dep')->on('department');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
