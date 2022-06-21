<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\Playerdata;

class ScrapingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ScrapingCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'スクレイピングコマンド';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=p');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
        $data = $tr->text();
      
        return $data;
        });
        foreach($info as $data) {
            
            $playerdata = new Playerdata;
            $playerdata->data = $data;
            $playerdata->save();
            
        };
        
    
    
     
        $client = new Client();
        $crawler = $client->request('GET', 'https://baseball.yahoo.co.jp/npb/teams/3/memberlist?kind=b');
        $info = $crawler->filter('.bb-playerTable__row')->each(function ($tr) {
        $data = $tr->text();
      
        return $data;
        });
        foreach($info as $data) {
            $playerdata = new Playerdata;
            $playerdata->data = $data;
            $playerdata->save();
        };
        
    }
}
