@extends('layouts.app')
@section('content')
<div class="container">
        <div class="col-md-12 col-md-offset-2">
            <h1>{{ $post->name }}</h1>
                <div class="card mb-3">

                    <div class="card-header">
                         Categoría
                         <a href="{{ route('category', $post->category->slug)}}">{{ $post->category->name }}</a>
                    </div>
                    
                    <div class="card-body">
                        @if($post->file)
                            <img src="{{ asset('storage/img/pictureArticle/'.$post->file) }}" class="img-responsive card-img-top" alt="{{ $post->name }}">
                        @endif
                        <p class="card-text">
                            {{ $post->excerpt }}
                        </p>
                        <hr>
                        {!! $post->body!!}
                        <hr>
                        @if($post->image)
                            <img src="{{ asset('storage/img/pictureArticleTwo/'.$post->image) }}" class="img-thumbnail img-fluid" width="50%" height="50%" alt="{{ $post->name }}">
                        @endif
                        <hr>
                        Etiquetas
                        @foreach($post->tags as $tag)
                        <a href="{{ route('tag', $tag->slug)}}">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
@endsection
