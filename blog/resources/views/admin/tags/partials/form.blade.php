@csrf
<div class="form-group ">
    <label for="name">Nombre de la etiqueta</label>
    <input id="name" class="form-control" type="text" name="name" value="{{ isset($tag)  ?  $tag->name : '' }}">
</div>
<div class="form-group">
    <label for="slug">URL Amigable</label>
    <input id="slug" class="form-control" type="text" name="slug" value="{{ isset($tag)  ?  $tag->slug : '' }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>