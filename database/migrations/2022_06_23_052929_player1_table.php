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
            $table->integer('atBat')->nullable();  //打数
            $table->integer('hit')->nullable(); // 安打
            $table->integer('rbi')->nullable();  // 打点
            $table->float('average', 4, 3)->nullable();// 打率	
            $table->integer('homerun')->nullable(); // 本塁打	
            $table->integer('stolenBase')->nullable(); // 盗塁
            $table->integer('game')->nullable();// 試合
            $table->integer('plateAppearance')->nullable();// 打席
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