<?php

namespace App\Http\Controllers;

use App\Models\Playerdata;
use Illuminate\Http\Request;

class ButterController extends Controller
{
    public function show(Request $request){
        return view('butter', ['playerdata' => $playerdata]);
    }
    
    // public function create(Request $request){
    //     $playerdata = new Playerdata;
        
    //     $playerdata->save();
        
    //     return view('butter');
    // }
}
