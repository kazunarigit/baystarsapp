<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;
use App\Models\Playerdata;


class ScrapingController extends Controller
{
    public function scraping(Request $request)
    {   // ここからスクレイピングデータを持ってくる。
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
            $data = $tr->text();
      
            return $data; // ここまで
        });//選手データ分繰り返し
        for($i = 1; $i < count($info); $i++)  {
            
            // データを分割
            $data = explode(" ", $info[$i]);
            // $playsername = $data[1].$data[2];
            // print_r($playerdata);
            // dd($playerdata);
            
            // dd($playerdata);
            // playerdataのインスタンスを生成し、データベースのテーブルに保存
            if($data[1] == "大和") {
                dd($data);
            }
            $playerdata = new Playerdata();
            $playerdata->playerlastname = $data[1];
            $playerdata->playerfirstname = $data[2];
            $playerdata->times_at_but = $data[5];
            $playerdata->hit = $data[7];
            $playerdata->hit_point = $data[12];
            $playerdata->hit_adv = $data[3];
            $playerdata->homeruns = $data[10];
            $playerdata->steals = $data[19];
            $playerdata->games = $data[4];
            $playerdata->box = $data[6];
        
            
            $playerdata->save();
            
        };
        return redirect('/pitcherinfo');
        
    
    
        //  public function butterscraping()
     // ここからスクレイピングでデータを持ってくる。
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
            $data = $tr->text();
      
            return $data; // ここまで
        }); //選手データ分繰り返し
        for($i = 1; $i < count($info); $i++) {
            // データを分割
            $data = explode(" ", $info[$i]);
            //print_r($playerdata) ;
            // dd($playerdata);
            
            // playerdataのインスタンスを生成し、データベースのテーブルに保存
            $playerdata2 = new Playerdata2();
            $playerdata2->playerlastname = $data[1];
            $playerdata2->playerfirstname = $data[2];
            $playerdata2->ining = $data[4];
            $playerdata2->hit_by_a_pitch = $data[16];
            $playerdata2->by_homeruns = $data[17];
            $playerdata2->wins = $data[9];
            $playerdata2->loses = $data[10];
            $playerdata2->saves = $data[13];
            $playerdata2->resp_points = $data[25];
            $playerdata2->lost_points = $data[24];
            $playerdata2->saved_adv = $data[3];
            
            $playerdata2->save();
        };
        return redirect('/butterinfo');
    }    
    
}

