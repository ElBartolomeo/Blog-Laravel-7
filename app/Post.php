<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Post extends Model
{
    //Permite salvar datos de forma masiva, 
    protected $fillable = [
        'user_id','category_id','name','slug','excerpt','body','status','file'
    ];

    //Se termina de dar de alta los métodos y relaciones faltantes. 
    //Un post pertenece un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Un post pertenece a una categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //Se indica a laravel la relación de post y muchas etiquetas 
    public function tags()
    {
        return $this->belongsToMany(Tag::class); //pertenece y tiene muchas etiquetas
    }
    //
    
    public static function setCaratula($file, $actual = false){
        if($file){
            if($actual) {
                Storage::disk('public')->delete("img/pictureArticle/$actual");
            }
            $pictureName = Str::random(20) .'.jpg';
            $picture = Image::make($file)->encode('jpg',75);
            $picture->resize(708, 236, function($constraint){
                $constraint->upsize();
            });
            Storage::disk('public')->put("img/pictureArticle/$pictureName",$picture->stream());
            return $pictureName;
        }else{
            return false;
        }
    }
}
