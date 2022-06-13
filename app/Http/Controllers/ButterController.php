<?php

namespace App\Http\Controllers;

use app\models\Playerdata;
use Illuminate\Http\Request;

class ButterController extends Controller
{
    public function show(){
        return view('butter');
    }
}
