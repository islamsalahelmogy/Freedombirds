<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body'
    ];
  
    public function likes()
    {
        return $this->belongsToMany('App\User','App\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function user()
     {
        return $this->belongsTo('App\User');
     }
}
