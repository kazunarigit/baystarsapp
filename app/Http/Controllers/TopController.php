<?php

namespace App\Http\Controllers;

use App\Models\Playerdata;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index(Request $request){
        return view('top');
    }
}
