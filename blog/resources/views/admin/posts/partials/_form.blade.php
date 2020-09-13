             @csrf
             <div class="form-group">
            <input type="text" name="user_id" class="form-control" value="{{ 'user_id', auth()->user()->id }}">
            </div>

            <select class="form-control">
            @foreach($categories as $id => $name)
                <option value="{{ $id }}"
                    {{ (isset($post->category->id) && $id == $post->category->id) ? 'selected' : ''  }}>{{ $name}}
                </option>
            @endforeach
            </select>   

            <div class="form-group">
                <label>Nombre de la Entrada</label>
                <input type="text" name="name" class="form-control" id = "name"  value="{{ old('name', $post->name)}}">
            </div>
            <div class="form-group">
                <label>URL amigable de cada Entrada</label>
                <input type="text" name="slug" class="form-control" id = "permalink"  value="{{ old('slug', $post->slug)}}" readonly>
            </div>
            <div class="form-group">
                <label>Contenido de esta entrada</label>
                <input type="textarea"  class="form-control" name="body"  value="{{ old('body', $post->body)}}">
            </div>
            <button type="submit" class="btn btn-primary">{{$btnText}}</button>
        

            @section('scripts')
            <script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js') }}"></script>
            <script>
                $(document).ready( function() {
                    $("#name").stringToSlug();
                });
            </script>
            @endsection 