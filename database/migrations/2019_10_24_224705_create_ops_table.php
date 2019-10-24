<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ops', function (Blueprint $table) {
            $table->bigIncrements('id');
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
        Schema::dropIfExists('ops');
    }
}
