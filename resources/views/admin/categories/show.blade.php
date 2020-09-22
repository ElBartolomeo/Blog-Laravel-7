@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
            <h2>Ver Categoría<h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <p><strong>Nombre: </strong>        {{$category->name}}</p>
        <p><strong>Slug: </strong>          {{$category->name}}</p>
        <p><strong>Creado: </strong>        {{$category->created_at}}</p>
        <p><strong>Actualizado: </strong>   {{$category->updated_at}}</p>
        <p><strong>Contenido: </strong>     {{$category->body}}</p>
    </div>
    <div class="card-footer text-muted">
        https://getbootstrap.com/docs/4.5/content/tables/
    </div>
    </div>
</div>    
@endsection