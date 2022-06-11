<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;

class ScrapingController extends Controller
{
    public function scraping()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
        $titles = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
            //選手のピッチャーの成績データを取り出す。→投球回、勝ち、負け
           $title = $tr;
            return $title;
        });
        return view('scraping', compact('titles'));
        
        /*
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
        $titles = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
            $title = $tr->filter('.bb-playerTable__data--player')->text();
            return $title;
        });
        return view('scraping', compact('titles'));
    }*/
    
    
}
