<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Storage;

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
        //->where('user_id', auth()->user()->id)  //Permite mostrar los post que le pertenecen a cada usuario y verlo desde el index que los muestra.
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
        $tags       = Tag::orderBy('name','ASC')->get();                   //Se envia el listado de etiquetas de forma alfabetica para ser usada en un check box

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
        
        $user_id = auth()->user()->id;
        $request->request->add(['user_id' => $user_id]);
        
        //Imagen
        //Gestiona la imagen subida
        if($request->hasFile('file_up'))
        {
            // Se busca el nombre del archivo junto con la extensión que se envio desde el formulario.
            $filenameWithExt = $request->file('file_up')->getClientOriginalName();
            // Se obtine solo el nombre del archivo
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Se obtine solo la extensión del archivo
            $extension = $request->file('file_up')->getClientOriginalExtension();
            // Se crea el nombre para guardarlo
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Sube y guarda la imagen
            $path = $request->file('file_up')->storeAs('public/img/pictureArticle', $fileNameToStore);
        } else
        {
            // Si no se sube imagen coloca pone este nombre.
            $fileNameToStore = 'noimage.jpg';
        }

        //Imagen
        //Gestiona la segunda imagen subida
        if($request->hasFile('image_up'))
        {
            // Se busca el nombre del archivo junto con la extensión que se envio desde el formulario.
            $imagenameWithExt = $request->image('image_up')->getClientOriginalName();
            // Se obtine solo el nombre del archivo
            $imagename = pathinfo($imagenameWithExt, PATHINFO_FILENAME);
            // Se obtine solo la extensión del archivo
            $extension = $request->image('image_up')->getClientOriginalExtension();
            // Se crea el nombre para guardarlo
            $imageNameToStore = $imagename.'_'.time().'.'.$extension;
            // Sube y guarda la imagen
            $path = $request->image('image_up')->storeAs('public/img/pictureArticleTwo', $imageNameToStore);
        } else
        {
            // Si no se sube imagen coloca pone este nombre.
            $imageNameToStore = 'noimage.jpg';
        }

        //Se adjunta al request el campo file y image con el nombre que hemos creado.
        $request-> request->add(['file'=>$fileNameToStore]);
        $request-> request->add(['image'=>$imageNameToStore]);

        //Salva los datos
        $post = Post::create($request->all());//Acepta datos masivos, pero en post hay control de los campos que se necesitan
        
        //Tags
        $post->tags()->attach($request->get('tags')); 

        return redirect()->route('posts.edit', $post->id)->with('info','Entrada Creada con éxito');
        
        /**
        *dd($request->all());
        *return $user_id; 
        *dd(auth()->user());    
        *dd($user_id);
         **/  
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
        /*dd($xxx); - Ver en pantalla información */
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags       = Tag::orderBy('name','ASC')->get();
        $post       = Post::find($id);
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
   
    {  
        
        /*dd();
        return $request->all();*/

        $post = Post::find($id);

        //Imagen
        //Gestiona la imagen de la entrada si se quiere actualizar
        if($request->hasFile('file_up'))
        {
            // Elimina la anterior imagen de la entrada
            Storage::delete('public/img/pictureArticle/'.$post->file);
            // Se busca el nombre del archivo junto con la extensión que se envio desde el formulario. 
            $filenameWithExt = $request->file('file_up')->getClientOriginalName();
            // Se obtine solo el nombre del archivo
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Se obtine solo la extensión del archivo
            $extension = $request->file('file_up')->getClientOriginalExtension();
            // Crea el nombre para guardarlo
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Sube y guarda la imagen nueva
            $path = $request->file('file_up')->storeAs('public/img/pictureArticle', $fileNameToStore);
        } else
        {
            // Si no se sube imagen mantiene el nombre de la anterior imagen.
            $fileNameToStore = $post->file;
        }

        //Se adjunta al request el campo file con el nombre que hemos creado.
        $request-> request->add(['file'=>$fileNameToStore]);

        //Salva los datos
        $post->fill($request->all())->save();

        //Sincroniza las etiquetas de la entrada Tags
        $post->tags()->sync($request->get('tags'));
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
        $post = Post::find($id);
        //Borra la imgen que tiene una Entrada
        if($post->file != 'noimage.jpg')
            {
            Storage::delete('public/img/pictureArticle/'.$post->file);
            }

        $post->delete();
        return back()->with('info','Eliminado correctamente');
    }
}
