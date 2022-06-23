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
// Route::post('/butterinfo', 'ButterController@create')->name('butterinfo');
// Route::post('/pitcherinfo', 'PitcherController@create')->name('pitcherinfo');



//Route::get('/', 'TopController@index');

Route::get('/scraping', 'ScrapingController@scraping')->name('scraping');// scraping
Route::get('/scraping', 'ScrapingController@create')->name('scraping');// scraping
/*
Route::get('/pitcherinfo', function() {
    $crawler = Goutte::request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
    $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
      $data = $tr->text();
      
      return $data;
    });
    foreach($info as $data) {
        $playerdata = explode(" ", $data);
        // print_r($playerdata) ;
        dump($playerdata);
    };
    return view('pitcher');
});


Route::get('/butterinfo', function() {
    $crawler = Goutte::request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
    $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
      $data = $tr->text();
      
      return $data;
    });
    foreach($info as $data) {
        $playerdata = explode(" ", $data);
        // print_r($playerdata) ;
        dump($playerdata);
    };
    return view('butter');
});
*/