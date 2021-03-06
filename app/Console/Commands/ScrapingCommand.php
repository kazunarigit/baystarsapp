<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\Playerdata;
use App\Models\Playerdata2;

class ScrapingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ScrapingCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'スクレイピングコマンド';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
            $tdData = $tr->filter('.bb-playerTable__data')->each(function ($td) {
                });
                return $tdData;
            });
            
        
         //選手データ分繰り返し
         // for($i = 1; $i < count($info); $i++)  {
            foreach($info as $data) {
                if (empty($data)) continue;
                    $firstName = null;
                    $lastName = null;
                // データを分割
                // 空白が含む場合
                    if (str_contains($data[1], ' ')) {
                    // 空白が含む場合は 苗字、名前で分割
                        $name = explode(" ", $data[1]);
                        $lastName = $name[0];
                        $firstName = $name[1];
                    } else {
                    // 含まない場合は苗字
                        $lastName = $data[1];
                    }
            
                    // playerdataのインスタンスを生成し、データベースのテーブルに保存
            
                    $playerdata = new Playerdata();
                    $playerdata->lastname = $lastName;
                    $playerdata->firstname = $firstName;
                    $playerdata->times_at_but = $data[5];
                    $playerdata->hit = $data[7];
                    $playerdata->hit_point = $data[12];
                    $playerdata->hit_adv = (int)$data[3] / 100;
                    $playerdata->homeruns = $data[10];
                    $playerdata->steals = $data[19];
                    $playerdata->games = $data[4];
                    $playerdata->box = $data[6];
                    // if($data[1] == "オースティン") {
                    //     dd($data,$playerdata);
                    // }
                    
                    $playerdata->save();
            }        
            
        
        
    
    
     
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
            $tdData = $tr->filter('.bb-playerTable__data')->each(function ($td) {
                });
                return $tdData;
            });
            
        
            //選手データ分繰り返し
         // for($i = 1; $i < count($info); $i++)  {
            foreach($info as $data) {
                if (empty($data)) continue;
                    $firstName = null;
                    $lastName = null;
                    // データを分割
                    // 空白が含む場合
                    if (str_contains($data[1], ' ')) {
                    // 空白が含む場合は 苗字、名前で分割
                    // $data = explode(" ", $info[$i]);
                        $name = explode(" ", $data[i]);
                        $lastName = $name[0];
                        $firstName = $name[1];
                    } else {
                    // 含まない場合は苗字
                        $lastName = $data[1];
            
                    }
                
                    // playerdataのインスタンスを生成し、データベースのテーブルに保存
                    $playerdata2 = new Playerdata2();
                    $playerdata2->lastname = $lastName;
                    $playerdata2->firstname = $firstName;
                    $playerdata2->ining = $data[4];
                    $playerdata2->hit_by_a_pitch = $data[16];
                    $playerdata2->by_homeruns = $data[17];
                    $playerdata2->wins = $data[9];
                    $playerdata2->loses = $data[10];
                    $playerdata2->saves = $data[13];
                    $playerdata2->resp_points = $data[25];
                    $playerdata2->lost_points = $data[24];
                    $playerdata2->saved_adv = (int)$data[3] / 100;
                    
                    $playerdata2->save();
            }        
    }
}    
