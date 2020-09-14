<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','DESC')
        ->where('user_id', auth()->user()->id) // Permite mostrar los post que le pertenecen a cada usuario y verlo desde el index que los muestra.
        
        ->paginate();
        //dd($posts);
        return view('admin.posts.index', compact('posts')); // El array se puede escribir tambien como ['posts'=>'$posts']
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name','ASC')->pluck('name','id'); //Se envia el listado de categorias de forma alfabetica, con solo nombre y id
        $tags       = Tag::orderBy('name','ASC')->get();                   //Se envia el listado de etiquetas de forma alfabetica para ser vista en un check box

        return view('admin.posts.create',[
                'post'=> new post // se envia un proyecto vacio {{ old('xxxx', null)}} = {{ old('xxxx')}}, esta linea es para hacer identicos los formularios y poder reutizar uno para guardar y editar.
        ],compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        /**
        return request(); */
        //Salva los datos
         $post = Post::create($request->all());//Acepta datos masivos, pero en post hay control de los campos que se necesitan 
        return redirect()->route('posts.edit', $post->id)
        ->with('info','Entrada Creada con éxito');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         /*dd($id); - Ver en pantalla información que ha encontrado*/
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags       = Tag::orderBy('name','ASC')->get();
        $post       = Post::find($id);
       /* dd($post); */
         return view('admin.posts.edit', compact('post','categories','tags'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
   
    {  /*
        dd();*/

        $post = Post::find($id);
        
        $post->fill($request->all())->save();

        return redirect()->route('posts.edit', $post->id)
        ->with('info','Entrada actualizada con éxito');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id)->delete();
        return back()->with('info','Eliminado correctamente');
    }
}
