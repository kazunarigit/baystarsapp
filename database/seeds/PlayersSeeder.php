<?php


use Illuminate\Database\Seeder;
use App\Models\Playerdata;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Playerdata::create([
            'id'=> 1,
           'playername' => '選手名', 
            'times_at_but' => 1,  //打数
            'hit' => 1, // 安打
            'hit_point' => 1,  // 打点
            'hit_adv' => 1,// 打率	
            
            'homeruns' => 1, // 本塁打	
            'steals' => 1, // 盗塁	
            'ining' => 1, // 投球回	
            'balls' => 1, // 球数	
            'hit_by_a_pitch' => 1, // 被安打	
            'by_homeruns' => 1, // 被本塁打	
            'wins' => 1, // 	勝ち
            'loses' => 1, // 敗け	
            'saves' => 1, // セーブ	
            'resp_points' => 1, // 自責点	
            'lost_points' => 1, // 失点	
            'saved_adv' => 1, // 防御率
            ]);
    }
}
