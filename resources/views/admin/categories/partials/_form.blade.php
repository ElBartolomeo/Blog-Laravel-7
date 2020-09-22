             @csrf
            <div class="form-group">
                <label>Nombre de la Categoría</label>
                <input type="text" name="name" class="form-control" id = "name"  value="{{ old('name', $category->name)}}">
            </div>
            <div class="form-group">
                <label>URL amigable de cada Categoría</label>
                <input type="text" name="slug" class="form-control" id = "permalink"  value="{{ old('slug', $category->slug)}}" readonly>
            </div>
            <div class="form-group">
                <label>Descripción de esta categoría</label>
                <input type="textarea"  class="form-control" name="body"  value="{{ old('body', $category->body)}}">
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