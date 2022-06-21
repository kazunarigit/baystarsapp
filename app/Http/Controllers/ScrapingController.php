<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;
use App\Models\Playerdata;


class ScrapingController extends Controller
{
    public function scraping1()
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
            dump($playerdata);
            
            $playerdata = Playerdata::select('playername', 'ining', 'balls', 'hit_by_a_pitch', 'by_homeruns', 'wins', 'loses', 'saves', 'resp_points', 'lost_points', 'saved_adv')->get();
            // dd($playerdata);
            // $playerdata->save();
        };
        return redirect('/pitcher');
    }    
    
    
     public function scraping2()
     {
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
        $data = $tr->text();
      
        return $data;
        });
        foreach($info as $data) {
            $playerdata = explode(" ", $data);
            //print_r($playerdata) ;
            dump($playerdata);
            
            $playerdata = Playerdata::select('playername', 'times_at_but', 'hit', 'hit_point', 'hit_adv')->get();
            
            // $playerdata->save();
            
        };
        return redirect('/butter',);
    }
    
}

