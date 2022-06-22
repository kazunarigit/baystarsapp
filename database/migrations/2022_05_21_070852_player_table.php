<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playerdata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('playername'); 
            $table->integer('times_at_but');  //打数
            $table->integer('hit'); // 安打
            $table->integer('hit_point');  // 打点
            $table->float('hit_adv', 4, 3);// 打率	
            $table->integer('homeruns'); // 本塁打	
            $table->integer('steals'); // 盗塁
            
            $table->integer('ining'); // 投球回	
            $table->integer('balls'); // 球数	
            $table->integer('hit_by_a_pitch'); // 被安打	
            $table->integer('by_homeruns'); // 被本塁打	
            $table->integer('wins'); // 	勝ち
            $table->integer('loses'); // 敗け	
            $table->integer('saves'); // セーブ	
            $table->integer('resp_points'); // 自責点	
            $table->integer('lost_points'); // 失点	
            $table->float('saved_adv', 3 , 2); // 防御率	
            
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
        Schema::dropIfExists('playerdata');
    }

    
}

    