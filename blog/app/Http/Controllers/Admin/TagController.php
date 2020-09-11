<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;

use App\Http\Controllers\Controller;

use App\Tag;

class TagController extends Controller
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
        $tags = Tag::orderBy('id','DESC')->paginate();
        //dd($tags);
        return view('admin.tags.index', compact('tags')); // El array se puede escribir tambien como ['tags'=>'$tags']
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request)
    {
        /**
        return request(); */
        //Salva los datos
         $tag = Tag::create($request->all());//Acepta datos masivos, pero en tag hay control de los campos que se necesitan 
        return redirect()->route('tags.edit', $tag->id)
        ->with('info','Etiqueta Creada con éxito');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.show', compact('tag'));
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
        
        $tag = Tag::find($id);
       /* dd($tag); */
         return view('admin.tags.edit', compact('tag'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $id)
   
    {  
        dd($request->all());

        /*$tag = Tag::find($id);
        
        $tag->fill($request->all())->save();

        return redirect()->route('tags.edit', $tag->id)
        ->with('info','Etiqueta actualizada con éxito');
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id)->delete();
        return back()->with('info','Eliminado correctamente');
    }
}
