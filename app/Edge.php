<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    //

    protected $hidden = [
        'created_at', 'updated_at', 'in_node_id'
    ];

    public function node()
    {
        return $this->belongsTo('App\Node');
    }
}
