@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
            <h2>Lista de Entradas<h2>
            </div>
            <div class="col">
            <a class="btn btn-primary float-right" href="{{ route('posts.create')}}" role="button">Crear</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
            <th scope="col" width="10px">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col" colspan="3">&nbsp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post) 
            <tr>
                <th scope="row">{{ $post->id}}</th>
                <td>{{ $post->name}}</td>
                <td width="10px">
                    <a class="btn btn-outline-dark float-right" href="{{ route('posts.show', $post->id )}}" role="button">Ver</a>
                </td>
                <td width="10px">
                    <a class="btn btn-outline-dark float-right" href="{{ route('posts.edit', $post->id)}}" role="button">Editar</a>
                </td>
                <td width="10px">
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->render() }}
    </div>
    <div class="card-footer text-muted">
        https://getbootstrap.com/docs/4.5/content/tables/
    </div>
    </div>
</div>    
@endsection