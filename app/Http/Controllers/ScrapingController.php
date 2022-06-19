<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;

include 'playerdata.php';

class ScrapingController extends Controller
{
    public function scraping(Request $request, Playerdata $playerdata, $playername)
    {
        $crawler = Goutte::request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
        $data = $tr->text();
      
        return $data;
        });
        foreach($info as $data) {
        $playerdata = explode(" ", $data);
        //print_r($playerdata) ;
        dump($playerdata[4]);
        
        $playerdata = Playerdata::select('playername', 'ining', 'balls', 'hit_by_a_pitch', 'by_homeruns', 'wins', 'loses', 'saves', 'resp_points', 'lost_points', 'saved_adv');
        
        $playerdata->save();
        };
    return view('pitcher');
    
    
     

        $crawler = Goutte::request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
        $data = $tr->text();
      
        return $data;
        });
        foreach($info as $data) {
        $playerdata = explode(" ", $data);
        //print_r($playerdata) ;
        dump($playerdata[4]);
        
        $playerdata = Playerdata::select('playername', 'times_at_but', 'hit', 'hit_point', 'hit_adv');
        
        $playerdata->save();
        };
    return view('butter');
    }
    
}

/*
# ここにインポート文を書く。
import playerdata from 

# 登録するデータ（function)
public function ()


# データを保存する処理
*/