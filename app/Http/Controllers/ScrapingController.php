<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;
use App\Models\Playerdata;
use App\Models\Playerdata2;


class ScrapingController extends Controller
{
    public function scraping(Request $request)
    {   // ここからスクレイピングデータを持ってくる。
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
            $tdData = $tr->filter('.bb-playerTable__data')->each(function ($td) {
                return $td->text();
            });
            return $tdData;
        });//1か月ごとから試合分の結果を配列で取得～選手のデータを取得
         // for($i = 1; $i < count($info); $i++)  {
            foreach($info as $data) {
                if (empty($data)) continue;
                    $firstName = null;
                    $lastName = null;
                    dump($info);
                 // データを分割
                 // 空白が含む場合
                    if (str_contains($data[1], ' ')) {
                    // 空白が含む場合は 苗字、名前で分割
                        $name = explode(" ", $data[1]);
                        $lastName = $name[0];
                        $firstName = $name[1];
                    } else {
                    // 含まない場合は苗字
                        $lastName = $data[1];
                    }
                    
                // playerdataのインスタンスを生成し、データベースのテーブルに保存
            
                $playerdata1 = new Playerdata();
                $playerdata1->lastname = $lastName;
                $playerdata1->firstname = $firstName;
                $playerdata1->times_at_but = $data[5];
                $playerdata1->hit = $data[7];
                $playerdata1->hit_point = $data[12];
                $playerdata1->hit_adv = (int)$data[3] / 100;
                $playerdata1->homeruns = $data[10];
                $playerdata1->steals = $data[19];
                $playerdata1->games = $data[4];
                $playerdata1->box = $data[6];
                 // if($data[1] == "オースティン") {
                 //         dd($data,$playerdata);
                 //     }
            
                $playerdata1->save();
            }    
    
            return redirect('/pitcherinfo');
        
        //  public function butterscraping()
     // ここからスクレイピングでデータを持ってくる。
        $client = new Client();
        // 月ごとの試合のURLを書く。https://baseball.yahoo.co.jp/npb/teams/3/schedule?month=2022-04
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
        // ページの試合結果に飛ぶタグの指定　bb-calendarTable__status
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
            $tdData = $tr->filter('.bb-playerTable__data')->each(function ($td) {
               return $td->text(); 
            });
            return $tdData();
        });
        // for($i = 1; $i < count($info); $i++)  {
            foreach($info as $data) {
                if (empty($data)) continue;
                $firstName = null;
                $lastName = null;
                // データを分割
                // 空白が含む場合
                if (str_contains($data[1], ' ')) {
                    // 空白が含む場合は 苗字、名前で分割
                    // $data = explode(" ", $info[$i]);
                    $name = explode(" ", $data[i]);
                    $lastName = $name[0];
                    $firstName = $name[1];
                } else {
                    // 含まない場合は苗字
                    $lastName = $data[1];
                }
            
               
                // playerdataのインスタンスを生成し、データベースのテーブルに保存
                $playerdata2 = new Playerdata2();
                $playerdata2->lastname = $lastName;
                $playerdata2->firstname = $firstName;
                $playerdata2->ining = $data[4];
                $playerdata2->hit_by_a_pitch = $data[16];
                $playerdata2->by_homeruns = $data[17];
                $playerdata2->wins = $data[9];
                $playerdata2->loses = $data[10];
                $playerdata2->saves = $data[13];
                $playerdata2->resp_points = $data[25];
                $playerdata2->lost_points = $data[24];
                $playerdata2->saved_adv = (int)$data[3] / 100;
                
                $playerdata2->save();
            }    
    
            return redirect('/butterinfo');
    }
}

// 月ごとの試合結果の一覧ページのURLを書く　https://baseball.yahoo.co.jp/npb/teams/3/schedule?month=2022-04
$client = new Client();
$crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/schedule?month=2022-04');// 4月の日程
// 月ごとの試合結果の一覧ページをクローリングし、試合があった日の試合結果を表示するURLから取得するデータのタグを指定　bb-calendarTable__status
$info = $crawler->filter('.bb-calendarTable__status')->each(function ($tr) {
// テキスト（文字列）で返す
    return $tr->text();
});
// 結果を出力
var_dump($info);
    // URLから試合結果を取得（配列で日数分取得できるようにする）1か月ごとから試合分の結果を配列で取得
    foreach($months as $days){
// 1試合ごとのページをクローリングし、その日の試合結果を取得。
// ここにもクローリングするURLは必要か？必要なら、1試合ごとの結果ページのURLを書く。（または取ってくるタグを書く）
// 試合がなければ、データの取得なし
        if($days == null){
            
        }else{
            
        }

// 試合結果から選手ごとのその日の試合内容を取得（投手の一覧、打者の一覧ページのURLとタグ（'.bb-playerTable__row','.bb-playerTable__data'）
    }
// テーブルに保存