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
            $table->integer('ining')->nullable(); // 投球回	
            $table->integer('hit_by_a_pitch')->nullable(); // 被安打	
            $table->integer('by_homeruns')->nullable(); // 被本塁打	
            $table->integer('wins')->nullable(); // 	勝ち
            $table->integer('loses')->nullable(); // 敗け	
            $table->integer('saves')->nullable(); // セーブ	
            $table->integer('resp_points')->nullable(); // 自責点	
            $table->integer('lost_points')->nullable(); // 失点	
            $table->float('saved_adv', 3 , 2)->nullable();; // 防御率	
            
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
