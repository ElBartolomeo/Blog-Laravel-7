<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('post_id')->index();   
            $table->unsignedBigInteger('tag_id')->index();  

            $table->timestamps();

            
            //Relation - Relaciones 
            
            $table->foreign('post_id')->references('id')->on('posts') //un post puede tener muchas etiquetas
                ->onDelete('cascade')
                ->onUpdate('cascade');
               
            $table->foreign('tag_id')->references('id')->on('tags') //una etiqueta puede tener muchos post
                ->onDelete('cascade')
                ->onUpdate('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
