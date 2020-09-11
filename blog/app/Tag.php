<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //Permite salvar datos de forma masiva, 
    protected $fillable = [
        'name','slug',
    ];

    //Una etiquete tine y pertenece a muchos post
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
