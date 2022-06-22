<?php

namespace App\Http\Controllers;

use App\Models\Playerdata;
use Illuminate\Http\Request;

class PitcherController extends Controller
{
    public function show(Request $request){
        return view('pitcher');
    }
    public function create(Request $request){
        $playerdata = new Playerdata;
        
        $playerdata->save();
    }
}
