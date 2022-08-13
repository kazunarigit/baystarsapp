<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;
use App\Models\Playerdata;
use App\Models\Playerdata2;


class ScrapingController extends Controller
{
    // public function scraping(Request $request)
    // {   // ここからスクレイピングデータを持ってくる。
    //     $client = new Client();
    //     $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
    //     $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
    //         $tdData = $tr->filter('.bb-playerTable__data')->each(function ($td) {
    //             return $td->text();
    //         });
    //         return $tdData;
    //     });//1か月ごとから試合分の結果を配列で取得～選手のデータを取得
    //      
    //                 }
                    
    //             // playerdataのインスタンスを生成し、データベースのテーブルに保存
            
    //             $playerdata1 = new Playerdata();
    //             $playerdata1->lastname = $lastName;
    //             $playerdata1->firstname = $firstName;
    //             $playerdata1->times_at_but = $data[5];
    //             $playerdata1->hit = $data[7];
    //             $playerdata1->hit_point = $data[12];
    //             $playerdata1->hit_adv = (int)$data[3] / 100;
    //             $playerdata1->homeruns = $data[10];
    //             $playerdata1->steals = $data[19];
    //             $playerdata1->games = $data[4];
    //             $playerdata1->box = $data[6];
    //              // if($data[1] == "オースティン") {
    //              //         dd($data,$playerdata);
    //              //     }
            
    //             $playerdata1->save();
    //         }    
    
    //         return redirect('/pitcherinfo');
        
    //     //  public function butterscraping()
    //  // ここからスクレイピングでデータを持ってくる。
    //     $client = new Client();
    //     // 月ごとの試合のURLを書く。https://baseball.yahoo.co.jp/npb/teams/3/schedule?month=2022-04
    //     $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
    //     // ページの試合結果に飛ぶタグの指定　bb-calendarTable__status
    //     $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
    //         $tdData = $tr->filter('.bb-playerTable__data')->each(function ($td) {
    //           return $td->text(); 
    //         });
    //         return $tdData();
    //     });
    //     
            
               
    //             // playerdataのインスタンスを生成し、データベースのテーブルに保存
    //             $playerdata2 = new Playerdata2();
    //             $playerdata2->lastname = $lastName;
    //             $playerdata2->firstname = $firstName;
    //             $playerdata2->ining = $data[4];
    //             $playerdata2->hit_by_a_pitch = $data[16];
    //             $playerdata2->by_homeruns = $data[17];
    //             $playerdata2->wins = $data[9];
    //             $playerdata2->loses = $data[10];
    //             $playerdata2->saves = $data[13];
    //             $playerdata2->resp_points = $data[25];
    //             $playerdata2->lost_points = $data[24];
    //             $playerdata2->saved_adv = (int)$data[3] / 100;
                
    //             $playerdata2->save();
    //         }    
    
    //         return redirect('/butterinfo');
    // }

    public function scraping(Request $request)
    {
        // 月ごとの試合結果の一覧ページのURLを書く　https://baseball.yahoo.co.jp/npb/teams/3/schedule?month=2022-04
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/schedule?month=2022-04');// 4月の日程
        // 月ごとの試合結果の一覧ページをクローリングする。
        // 試合があった日の試合結果を表示するURLから取得するデータのタグを指定　bb-calendarTable__status
        
        $info = $crawler->filter('.bb-calendarTable__status')->each(function ($tr) {
        // $infoのURLの配列をデータベースに保存
            return $tr->text();
        });
        
        // 結果を出力
        // var_dump($info);
        
        // URLから試合結果を取得（配列で日数分取得できるようにする）
        // 1か月ごとから試合分の結果を配列で取得
        foreach($info as $day){
        // 1試合ごとの試合結果をクローリングし、その日の試合結果を取得。https://baseball.yahoo.co.jp/npb/game/2021005458/top 数字はその日によって違う。
            $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/game/2021005458/top');// 1試合ごとのURL
    
        // 1試合ごとの対戦点数を取ってくる。○対×
            $topinfo = $crawler->filter('.bb-gamecard')->each(function ($tr) {
                return $tr->text();
            });
            
            // その日の試合の成績のURLを取ってくる。  
            $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/game/2021005458/stats/');// 4月1日のURL
            
            // その日の試合の選手の成績をクロールする。 投手：投球回など 打者：打席・安打など
            $statslist = $crawler->filter('.bb-statsTable__row')->each(function ($tr) {
                return $tr->text();
            });
            
            // 選手成績のテーブルから、DeNAがホームの場合、テーブルの上と下どちらからデータを取るか
            $teamname = $crawler->filter('.bb-teamScoreTable__row--home .bb-gameScoreTable__team--npbTeam3')->each(function ($tr) {
                return $tr->text();
                // DeNA7がホームなら見出しからクロールし、そうでない場合は見出し1からクロールする
                
                
            });
            
            // 選手の成績テーブル（.bb-statsTable__row）の選手の名前を上から順にクローリングして配列に入れる
            foreach($statslist as $statsinfo){ // これでいいですか？
            // ラベルの名前が位置なら飛ばして、選手の名前から見る。
                if(".bb-statsTable__headLabel" == "位置"){// ここが不明
                    continue;
                }
                // 処理の出力
                print_r($statsinfo);
            }
        }
            // DeNAの選手なら順に見ていき、違えば見ない。
            
            // dd($statsinfo, $statsinfo2);
            // 0ではなく、文字列型（空文字列）
            // dd($teamname);
            $team = "";
            
            // teamnameの配列の要素にDeNAがあるかないか判定
            if(array_key_exists("DeNA", $teamname)){
                // いればホーム
                $team = 'home';
                echo $team;
            }else{
                // いなければアウェイ
                $team = 'away';
                echo $team;
            }
            dd($teamname);
                
            // 処理の出力
            // print $day;
            
        

        // 試合結果から選手ごとのその日までの試合内容を取得（投手の通算成績一覧、打者の通算成績一覧ページのURLとタグ（'.bb-playerTable__row','.bb-playerTable__data'）
        // テーブルに保存
            
        return redirect('/scraping');
    }
}