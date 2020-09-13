@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
            <h2>Ver Etiqueta<h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <p><strong>Nombre: </strong>{{$tag->name}}</p>
        <p><strong>Slug: </strong>{{$tag->name}}</p>
        <p><strong>Creado: </strong>{{$tag->created_at}}</p>
        <p><strong>Actualizado: </strong>{{$tag->updated_at}}</p>
    </div>
    <div class="card-footer text-muted">
        https://getbootstrap.com/docs/4.5/content/tables/
    </div>
    </div>
</div>    
@endsection