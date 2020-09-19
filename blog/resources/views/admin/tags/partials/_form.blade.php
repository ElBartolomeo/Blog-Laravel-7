             @csrf
            <div class="form-group">
                <label>Nombre de la etiqueta</label>
                <input type="text" name="name" class="form-control" id = "name"  value="{{ old('name', $tag->name)}}">
            </div>
            <div class="form-group">
                <label>URL amigable</label>
                <input type="text" name="slug" class="form-control" id = "permalink"  value="{{ old('slug', $tag->slug)}}" readonly>
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