<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('pid')->default(0);
            $table->string('username', 32)->default('');
            $table->char('mobile', 11)->default('');
            $table->string('email', 32)->default('');
            $table->string('password', 64)->default('');
            $table->string('openid', 32)->default('');
            $table->string('nickname', 64)->default('');
            $table->string('headimgurl', 255)->default('');
            $table->softDeletes();
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
        Schema::dropIfExists('user');
    }
}
