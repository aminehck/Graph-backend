<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    //
    protected $fillable = [
        'in_node_id', 'out_node_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

}
