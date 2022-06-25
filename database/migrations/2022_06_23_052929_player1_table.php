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
            $table->string('lastname'); //苗字
            $table->string('firstname')->nullable(); //名前
            $table->integer('times_at_but');  //打数
            $table->integer('hit'); // 安打
            $table->integer('hit_point');  // 打点
            $table->float('hit_adv', 4, 3);// 打率	
            $table->integer('homeruns'); // 本塁打	
            $table->integer('steals'); // 盗塁
            $table->integer('games');// 試合
            $table->integer('box');// 打席
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