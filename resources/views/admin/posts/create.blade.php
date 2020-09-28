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
            <h2>Crear Una Entrada<h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action ="{{route('posts.store')}}" enctype="multipart/form-data">
        
        @include('admin.posts.partials._form',['btnText'=>'Guardar'])

        </form>
    </div>

    <div class="card-footer text-muted">
        https://getbootstrap.com/docs/4.5/content/tables/
    </div>
    </div>
</div>    
@endsection