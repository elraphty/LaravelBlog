<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table="posts";

    //Primary key
    public $primaryKey='id';

   //Timestamps
    public $timestamps=true;

    //Creating Relatiobships
    public function user(){
        return $this->belongsTo('App\User');
    }
}
