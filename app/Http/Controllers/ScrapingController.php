<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;
use App\Models\Playerdata;

//include('Playerdata.php') ;

class ScrapingController extends Controller
{
    public function scraping()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
        $data = $tr->text();
      
        return $data;
        });
        foreach($info as $data) {
            
            // $playerdata = new Playerdata;
            // $playerdata->playername = $data[1];
            $playerdata = explode(" ", $data);
            // print_r($playerdata);
            dump($playerdata[4]);
            
            $playerdata = Playerdata::select('playername', 'ining', 'balls', 'hit_by_a_pitch', 'by_homeruns', 'wins', 'loses', 'saves', 'resp_points', 'lost_points', 'saved_adv');
            // dd($playerdata);
            // $playerdata->save();
        };
        return view('pitcher');
    
    
     
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
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

