<?php

namespace App\Http\Controllers;

use App\Models\Playerdata;
use Illuminate\Http\Request;

class ButterController extends Controller
{
    public function show(Request $request){
        return view('butter');
    }
    public function datainsert(){
        $dataname = new Dataname();
        
        $dataname->create([
            'playername' => '',
            'times_at_but' => '',
            'hit' => '',
            'hit_adv' => '',
            'homeruns' => '',
            'steals' => ''
        ]);
    }
}
