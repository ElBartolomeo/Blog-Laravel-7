<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
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
        $categories = Category::orderBy('id','DESC')->paginate();
        //dd($categories);
        return view('admin.categories.index', compact('categories')); // El array se puede escribir tambien como ['categories'=>'$categories']
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create',[
                'category'=> new category // se envia un proyecto vacio {{ old('xxxx', null)}} = {{ old('xxxx')}}, esta linea es para hacer identicos los formularios y poder reutizar uno para guardar y editar.
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        /**
        return request(); */
        //Salva los datos
         $category = Category::create($request->all());//Acepta datos masivos, pero en category hay control de los campos que se necesitan 
        return redirect()->route('categories.edit', $category->id)
        ->with('info','Categoría Creada con éxito');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
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
        
        $category = Category::find($id);
       /* dd($category); */
         return view('admin.categories.edit', compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
   
    {  /*
        dd();*/

        $category = Category::find($id);
        
        $category->fill($request->all())->save();

        return redirect()->route('categories.edit', $category->id)
        ->with('info','Categoría actualizada con éxito');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();
        return back()->with('info','Eliminado correctamente');
    }
}
