             @csrf

            <!--user_id Está en PostController dentro de store como $user_id = auth()->user()->id;-->
           
            <!--name-->
            <div class="form-group">
                <label>Nombre de la Entrada</label>
                <input type="text" name="name" class="form-control" id = "name"  value="{{ old('name', $post->name)}}">
            </div>

            <!--slug-->
            <div class="form-group">
                <label>URL amigable</label>
                <input type="text" name="slug" class="form-control" id = "permalink"  value="{{ old('slug', $post->slug)}}" readonly>
            </div>

            <!--category_id-->
            <div class="form-group">
                <label>Escoge una categoría para esta entrada</label> 
                <select name="category_id" class="form-control">
                    @foreach($categories as $id => $name)
                    <option value="{{ $id }}"
                        {{ (isset($post->category->id) && ($id == $post->category->id)) ? 'selected' : ''}}>{{ $name}}
                    </option>
                    @endforeach
                </select>   
            </div>  

            <!--Tags-->
            <div class="form-group">
                <label>Escoge las etiquetas de esta entrada</label><br>
                    @foreach($tags as $tag)
                    <div  class="form-check form-check-inline">
                    <input class="form-check-input" name = "tags[]" type="checkbox"  value="{{ $tag->id }}">
                    <label class="form-check-label" >{{ $tag->name }}</label>
                    </div>
                    @endforeach 
            </div>
            <!--status-->
            <div class="form-group">
            <label>Estado de la entrada: </label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="status" id="status" value="{{'DRAFT'}}" checked> Borrador
                </label>
                <label class="btn btn-success">
                    <input type="radio"name="status" id="status" value="{{'PUBLISHED'}}"> Publicado
                </label>
                </div>
            </div> 

             <!--file-->
            <div class="form-group">
                <label>Imagen</label>
                <input type="file" name="file" class="form-control-file" value="{{'file'}}">
            </div>
    
            <!--excerpt-->
            <div class="form-group">
                <label>Descripción corta de esta entrada</label>
                <input type="textarea"  class="form-control" name="excerpt"  value="{{ old('excerpt', $post->excerpt)}}">
            </div>

            <!--body-->
            <div class="form-group">
                <label>Contenido de esta entrada</label>
                <input type="textarea"  class="form-control" name="body" id ='body'  value="{{ old('body', $post->body)}}">
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