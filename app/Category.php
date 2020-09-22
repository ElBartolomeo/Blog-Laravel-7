<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Permite salvar datos de forma masiva, 
    protected $fillable = [
        'name','slug','body'
    ];

    //Una categoria puede tener muchos post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}