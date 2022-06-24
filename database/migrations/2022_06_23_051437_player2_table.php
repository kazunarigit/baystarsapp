<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Player2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playerdata2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lastrname'); // 苗字
            $table->string('firstrname')->nullable()->change(); // 名前
            $table->integer('ining'); // 投球回	
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
        Schema::dropIfExists('playerdata2');
    }
}
