<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Player1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('playerdata1', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('player'); // 選手名
            $table->integer('times_at_but')->nullable();  //打数
            $table->integer('hit')->nullable(); // 安打
            $table->integer('hit_point')->nullable();  // 打点
            $table->float('hit_adv', 4, 3)->nullable();// 打率	
            $table->integer('homeruns')->nullable(); // 本塁打	
            $table->integer('steals')->nullable(); // 盗塁
            $table->integer('games')->nullable();// 試合
            $table->integer('box')->nullable();// 打席
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
        Schema::dropIfExists('playerdata1');
    }
    
}