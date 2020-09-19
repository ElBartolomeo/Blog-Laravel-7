@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
            <h2>Lista de Categorías<h2>
            </div>
            <div class="col">
            <a class="btn btn-primary float-right" href="{{ route('categories.create')}}" role="button">Crear</a>
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
            @foreach($categories as $category) 
            <tr>
                <th scope="row">{{ $category->id}}</th>
                <td>{{ $category->name}}</td>
                <td width="10px">
                    <a class="btn btn-outline-dark float-right" href="{{ route('categories.show', $category->id )}}" role="button">Ver</a>
                </td>
                <td width="10px">
                    <a class="btn btn-outline-dark float-right" href="{{ route('categories.edit', $category->id)}}" role="button">Editar</a>
                </td>
                <td width="10px">
                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->render() }}
    </div>
    <div class="card-footer text-muted">
        https://getbootstrap.com/docs/4.5/content/tables/
    </div>
    </div>
</div>    
@endsection