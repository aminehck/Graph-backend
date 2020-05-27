<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
    //
    public function nodes()
    {
        return $this->hasMany('App\Node');
    }
}
