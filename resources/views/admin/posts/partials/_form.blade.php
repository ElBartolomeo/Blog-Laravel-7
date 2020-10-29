             @csrf

            <!--user_id Está en PostController dentro de store como $user_id = auth()->user()->id;-->

            <!--status-->
            <div class="form-group">
            <label>Estado de la entrada: </label><br>
            @php
                $statusPost = $post->status;
            @endphp
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="status" value="{{'PUBLISHED'}}" class="custom-control-input"
                    @if ($statusPost === 'PUBLISHED')
                        checked
                    @endif>
                <label class="custom-control-label" for="customRadioInline1">Publicado</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="status" value="{{'DRAFT'}}" class="custom-control-input"
                    @if ($statusPost === 'DRAFT')
                        checked
                    @endif>
                <label class="custom-control-label" for="customRadioInline2">Borrador</label>
            </div>
            </div>

            <!--name-->
            <div class="form-group">
                <label>Nombre de la entrada</label>
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
                <label for="exampleFormControlSelect2">Escoge las etiquetas de esta entrada</label>
                <select multiple class="form-control" name="tags[]">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                          @foreach ($post->tags as $postTag)
                            @if ($postTag->id == $tag->id)
                              selected
                            @endif
                          @endforeach
                        >{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>


            <!--file-->
            <div class="form-group">
                <label>Imagen Uno</label>
                <input type="file" name="file_up" class="form-control-file" value="{{'file'}}" accept="image/*"/>
                @if($post->file)
                    <div class="d-flex justify-content-center">
                        <div class="col-sm-6">
                        <img class="img-thumbnail img-fluid" width="50%" height="50%" src="{{ asset('storage/img/pictureArticle/'.$post->file) }}" alt="{{ $post->name }}">
                        </div>
                    </div>
                @endif 
            </div>
            <hr>
            <!--image-->
            <div class="form-group">
                <label>Imagen Dos</label>
                <input type="file" name="image_up" class="form-control-file" value="{{'image'}}" accept="image/*"/>
                @if($post->file)
                    <div class="d-flex justify-content-center">
                        <div class="col-sm-6">
                        <img class="img-thumbnail img-fluid" width="50%" height="50%" src="{{ asset('storage/img/pictureArticleTwo/'.$post->image) }}" alt="{{ $post->name }}">
                        </div>
                    </div>
                @endif 
            </div>
    
            <!--excerpt-->
            <div class="form-group">
                <label>Descripción corta de esta entrada</label>
                <input type="textarea"  class="form-control" name="excerpt"  value="{{ old('excerpt', $post->excerpt)}}">
            </div>

            <!--body-->
            <div class="form-group">
                <label>Contenido de esta entrada</label>
                <textarea name="body" id ='body'>{{ old('body', $post->body)}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{$btnText}}</button>
        
            @section('scripts')

            <!-- stringToSlug -->
            <script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js') }}"></script>

            <!-- Editor de texto Summernote -->
            <script src="{{ asset('vendor/summernote/summernote-lite.min.js') }}"></script>

            <!-- Idioma Summernote-es-ES -->
            <script src="{{ asset('vendor/summernote/lang/summernote-es-ES.min.js') }}"></script>

            <script>
                // stringToSlug
                $(document).ready( function() {
                    $("#name").stringToSlug();
                });
            </script>
            <script>
                $('#body').summernote({
                    lang: 'es-ES', // default: 'en-US'  
                    placeholder: 'Aquí puedes escribir el texto de la entrada que quieres compartir',
                    tabsize: 2,
                    height: 400,
                    toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic','underline', 'clear']],
                    ['insert', ['link']],
                    ['view', ['codeview', 'help']]
                    ]
                });
            </script>

            @endsection