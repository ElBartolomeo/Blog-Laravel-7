@extends('layouts.app')

@section('MyStyles')
<link href="{{ asset('vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
            <h2>Editar Entrada<h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action ="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
        @method('PATCH')
        @include('admin.posts.partials._form',['btnText'=>'Actualizar'])      
        </form>
    </div>

    <div class="card-footer text-muted">
        https://getbootstrap.com/docs/4.5/content/tables/
    </div>
    </div>
</div>    
@endsection