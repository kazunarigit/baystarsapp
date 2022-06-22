<?php

namespace App\Http\Controllers;

use App\Models\Playerdata;
use Illuminate\Http\Request;

class PitcherController extends Controller
{
    public function show(Request $request){
        return view('pitcher');
    }
    public function datainsert(){
        $dataname = new Dataname();
        
        $dataname->create([
            'playername' => '',
            'ining' => '',
            'balls' => 'testpassword',
            'hit_by_a_pitch' => '',
            'by_homeruns' => '',
            'wins' => '',
            'loses' => '',
            'saves' => '',
            'resp_points' => '',
            'lost_points' => '',
            'saved_adv' => ''
        ]);
    }
}
