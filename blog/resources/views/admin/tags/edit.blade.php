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
        <form method="POST" action ="{{route('tags.update', $tag->id)}}">
        @method('PATCH')
        @include('admin.tags.partials._form',['btnText'=>'Actualizar'])
        
        </form>
    </div>

    <div class="card-footer text-muted">
        https://getbootstrap.com/docs/4.5/content/tables/
    </div>
    </div>
</div>    
@endsection