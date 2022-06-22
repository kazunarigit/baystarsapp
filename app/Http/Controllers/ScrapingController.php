<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;
use App\Models\Playerdata;


class ScrapingController extends Controller
{
    public function scraping()
    {   // ここからスクレイピングデータを持ってくる。
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
        $data = $tr->text();
      
        return $data; // ここまで
        });//選手データ分繰り返し
        foreach($info as $data) {
            
            // データを分割
            $playerdata = explode(" ", $data);
            // print_r($playerdata);
            dump($playerdata);
            
            // $playerdata = Playerdata::select('playername', 'ining', 'balls', 'hit_by_a_pitch', 'by_homeruns', 'wins', 'loses', 'saves', 'resp_points', 'lost_points', 'saved_adv')->get();
            // dd($playerdata);
            // $playerdata->save();
        };
        return redirect('/pitcherinfo');
        
    
    
    //  public function butterscraping()
     // ここからスクレイピングでデータを持ってくる。
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
        $data = $tr->text();
      
        return $data; // ここまで
        }); //選手データ分繰り返し
        foreach($info as $data) {
            // データを分割
            $playerdata = explode(" ", $data);
            //print_r($playerdata) ;
            dump($playerdata);
            
            // $playerdata = Playerdata::select('playername', 'times_at_but', 'hit', 'hit_point', 'hit_adv')->get();
            
            // $playerdata->save();
            
        };
        return redirect('/butterinfo');
    }
    
}

