<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    //
    protected $fillable = [
        'tootltip',
    ];
    
    protected $hidden = [
        'created_at', 'updated_at', 'graph_id'
    ];

    public function graph()
    {
        return $this->belongsTo('App\Graph');
    }

    public function edges()
    {
        return $this->hasMany('App\Edge', 'in_node_id', 'id');
    }
}
