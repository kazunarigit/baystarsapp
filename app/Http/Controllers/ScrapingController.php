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
            
            // dd($playerdata);
            // playerdataのインスタンスを生成し、データベースのテーブルに保存
            // $playerdata = new Playerdata();
            // $playerdata = $request->all();
            
            // $playerdata->fill($client);
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
        };
        return redirect('/butterinfo');
    }    
    public function create(Request $request){
            // playerdataのインスタンスを生成し、データベースのテーブルに保存
            $playerdata = new Playerdata();
            $playerdata = $request->all();
            
            // $playerdata->fill($client);
            $playerdata->save();
        }
    
    
}

