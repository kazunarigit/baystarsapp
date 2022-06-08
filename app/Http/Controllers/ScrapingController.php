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
           // $title = $li->filter('div.p13n-sc-truncate-desktop-type2')->text();
            return $title;
        });
        return view('scraping', compact('titles'));
        
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
        $titles = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
            //$title = $li->filter('div.p13n-sc-truncate-desktop-type2')->text();
            return $title;
        });
        return view('scraping', compact('titles'));
    }
    
    
}
