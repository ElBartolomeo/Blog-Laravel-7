             @csrf

            <!--user_id-->
            <div class="form-group">
                <input type="hidden" name="user_id" class="form-control" value="{{ 'user_id', auth()->user()->id }}">
            </div>

            <!--category_id-->
            <div class="form-group">
                <label>Escoge la categoría </label> 
                <select name="category_id" class="form-control">
                    @foreach($categories as $id => $name)
                    <option value="{{ $id }}"
                        {{ (isset($post->category->id) && $id == $post->category->id) ? 'selected' : ''}}>{{ $name}}
                    </option>
                    @endforeach
                </select>   
            </div>
          <!--tags usando checkbox
            <div class="form-group">
                <label>Escoge las etiquetas </label>
                    <div name = "tags" class="form-check form-check-inline">
                    @foreach($tags as $tag)
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{ 'category_id', $tag->id }}">
                    <label class="form-check-label" for="inlineCheckbox1">{{ $tag->name }}</label>
                    @endforeach
                    </div>
            </div>
          //-->
            <!--tags usando un selector-->
            <div class="form-group">
                <label>Escoge las etiquetas </label>
                <select  class="custom-select" data-live-search="true" multiple>
                    @foreach($tags as $tag)
                    <option value="{{ 'category_id', $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>


            <!--name-->
            <div class="form-group">
                <label>Imagen</label>
                <input type="file" name="file" class="form-control-file" value="{{'file'}}">
            </div>

            <!--status-->
            <div class="form-group">
                <label>Estado de la entrada: </label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="{{'PUBLISHED'}}">
                    <label class="form-check-label" for="inlineCheckbox1">Publicado</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="{{'DRAFT'}}">
                    <label class="form-check-label" for="inlineCheckbox2">Borrador</label>
                </div>
            </div>

            <!--name-->
            <div class="form-group">
                <label>Nombre de la Entrada</label>
                <input type="text" name="name" class="form-control" id = "name"  value="{{ old('name', $post->name)}}">
            </div>
            <div class="form-group">
                <label>URL amigable de cada Entrada</label>
                <input type="text" name="slug" class="form-control" id = "permalink"  value="{{ old('slug', $post->slug)}}" readonly>
            </div>

            <!--excerpt-->
            <div class="form-group">
                <label>Descripción de esta entrada</label>
                <input type="textarea"  class="form-control" name="excerpt"  value="{{ old('excerpt', $post->excerpt)}}">
            </div>

            <!--body-->
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