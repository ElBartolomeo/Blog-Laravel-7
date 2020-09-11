@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
            <h2>Crear Etiqueta<h2>
            </div>
            <div class="col">
            <a class="btn btn-primary float-right" href="{{ route('tags.create')}}" role="button">Crear</a>
            </div>
        </div>
    </div>
    <div class="card-body">

        <form method="POST" action ="{{route('tag.store')}}" >
            @csrf
            <div class="form-group">
                <label>Nombre de la etiqueta</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label>URL amigable</label>
                <input type="text" name="slug" class="form-control" id="slug">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <div class="card-footer text-muted">
        https://getbootstrap.com/docs/4.5/content/tables/
    </div>
    </div>
</div>    
@endsection