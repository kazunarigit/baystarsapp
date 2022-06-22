<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playerdata extends Model
{
    protected $table = 'playerdata';
    
    protected $fillable = ['playername', 'times_at_but', 'hit', 
        'hit_point', 'hit_adv', 'homeruns', 'steals', 'ining',
        'balls', 'hit_by_a_pitch', 'by_homeruns', 'wins', 
        'loses', 'saves', 'resp_points', 'lost_points', 'saved_adv'];
    
}
