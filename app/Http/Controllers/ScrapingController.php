<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;
use App\Models\Playerdata;
use App\Models\Playerdata2;


class ScrapingController extends Controller
{

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
                $tdData = $tr->filter('.bb-statsTable__data')->each(function ($td) {
                    return $td->text(); 
                });
                return $tdData;
            // return $tr->text();
            });
            // dd($statslist[1][1]);
            // 選手成績のテーブルから、DeNAがホームの場合、テーブルの上と下どちらからデータを取るか
            $teamname = $crawler->filter('.bb-teamScoreTable__row--home .bb-gameScoreTable__team--npbTeam3')->each(function ($tr) {
                return $tr->text();
                // DeNAがホームなら見出しからクロールし、そうでない場合は見出し1からクロールする
                
                
            });
            
            // 選手の成績テーブル（.bb-statsTable__row）の選手の名前を上から順にクローリングして配列に入れる
            //for文でデータの開始位置と終了値を設定して、回す
            $home = 1;
            for($i = $home; $i < count($statslist); $i++){
                // statslistでホームとアウェイの開始位置をどう判断するか？
                // if(".bb-statsTable__headLabel" == "位置"){// ここが不明
                //     continue;
                // }
                // 処理の出力
                // dd($statslist[$i]);
            }
        
            // DeNAの選手なら順に見ていき、違えば見ない。
            
            // dd($statslist);
            // 0ではなく、文字列型（空文字列）
            // dd($teamname);
            $team = "";
            
            // teamnameの配列に要素があるかないか判定
            if(count($teamname) == 0){
                // いればホーム
                $team = 'home';
                echo $team;
            }else{
                // いなければアウェイ
                $team = 'away';
                echo $team;
            }
            // dd($teamname);
                
            // 処理の出力
            // print $day;
            
        
    
            
            dd($statslist[0]);
            //  playerdataのインスタンスを生成し、データベースのテーブルに保存
            for($i = 1; $i < count($statslist) - 1; $i++){
                $playerdata1 = new Playerdata();
                // echo $statslist[$i][0] ;
                $playerdata1->player = $statslist[$i][1];//選手名
                $playerdata1->atBat = $statslist[$i][4];//打数
                $playerdata1->hit = $statslist[$i][6];//安打
                $playerdata1->rbi = $statslist[$i][7];//打点
                $playerdata1->average = (int)$statslist[$i][3] / 100;//打率
                $playerdata1->homerun = $statslist[$i][13];//本塁打
                $playerdata1->stolenBase = $statslist[$i][11];//盗塁
                // $playerdata1->game = $data[4];//試合
                // $playerdata1->plateAppearance = $data[3];//打席
    
                $playerdata1->save();
            
            }   
            
            // return view('/butterinfo');
        }
    
    //     
            
               
    //             // playerdataのインスタンスを生成し、データベースのテーブルに保存
            
            $playerdata2 = new Playerdata2();
            $playerdata2->player = $statslist[1];//選手名
            $playerdata2->inningsPitched = $statslist[3];//投球回
            $playerdata2->hitAllowed = $statslist[6];//被安打
            $playerdata2->homerunAllowed = $statslist[7];//被本塁打
            // $playerdata2->wins = $data[9];//勝
            // $playerdata2->loses = $data[10];
            // $playerdata2->saves = $data[13];
            $playerdata2->earnedRun = $statslist[13];//自責点
            $playerdata2->runAllowed = $statslist[12];//失点
            $playerdata2->era = (int)$statslist[2] / 100;//防御率
            
            $playerdata2->save();
    //         }    
    
            //  return view('/pitcherinfo');
            dd($playerdata);
        
        return view('/scraping');
    }
}