@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
            <h2>Editar Etiqueta<h2>
            </div>
        </div>
    </div>
    <div class="card-body">
    
    <form method="POST" action ="{{route('tag.update')}}" >
            @csrf @method('PATCH')
            <div class="form-group">
                <label>Nombre de la etiqueta</label>
                <input type="text" name="name" class="form-control"  value="{{ $tag->name}}">
            </div>
            <div class="form-group">
                <label>URL amigable</label>
                <input type="text" name="slug" class="form-control"  value="{{ $tag->slug}}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
    

    <div class="card-footer text-muted">
        https://getbootstrap.com/docs/4.5/content/tables/
    </div>
    </div>
</div>    
@endsection