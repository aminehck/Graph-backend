<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    //
    public function graph()
    {
        return $this->belongsTo('App\Graph');
    }

    public function edges()
    {
        return $this->hasMany('App\Edge', 'in_node_id', 'id');
    }
}
