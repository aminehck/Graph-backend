<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
    //

    protected $fillable = [
        'name', 'description',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function nodes()
    {
        return $this->hasMany('App\Node');
    }
}
