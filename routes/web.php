<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/butterinfo', 'ButterController@show');
Route::get('/pitcherinfo', 'PitcherController@show'); # 追記
    

//Route::get('/', 'TopController@index');

Route::get('/scraping', 'ScrapingController@scraping')->name('scraping');// scraping

Route::get('/', function() {
    $crawler = Goutte::request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
    $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
      $data = $tr->text();
      
      return $data;
    });
    foreach($info as $data) {
        $playerdata = explode(" ", $data);
        //print_r($playerdata) ;
        dump($playerdata[4]);
    };
    return view('welcome');
});

/*
Route::get('/', function() {
   $crawler = Goutte::request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
    $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
      dump($tr->text());
   });
    dd($crawler);
    return view('welcome');
});
*/