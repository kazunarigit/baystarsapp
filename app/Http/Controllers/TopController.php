<?php

namespace App\Http\Controllers;

use App\models\Playerdata;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index(){
        return view('top');
    }
}
