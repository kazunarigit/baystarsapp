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
            $table->string('player'); // 選手名
            $table->integer('inningsPitched')->nullable(); // 投球回	
            $table->integer('hitAllowed')->nullable(); // 被安打	
            $table->integer('homerunAllowed')->nullable(); // 被本塁打	
            $table->integer('win')->nullable(); // 	勝ち
            $table->integer('lose')->nullable(); // 敗け	
            $table->integer('save')->nullable(); // セーブ	
            $table->integer('earnedRun')->nullable(); // 自責点	
            $table->integer('runAllowed')->nullable(); // 失点	
            $table->float('era', 3 , 2)->nullable();; // 防御率	
            
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
