<?php

namespace App\Http\Controllers;

use App\models\Playerdata;
use Illuminate\Http\Request;

class PitcherController extends Controller
{
    public function show(){
        return view('pitcher');
    }
}
