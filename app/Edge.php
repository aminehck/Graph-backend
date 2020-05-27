<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    //
    public function node()
    {
        return $this->belongsTo('App\Node');
    }
}
