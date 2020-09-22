<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'          => 'required',
            'slug'          => 'required|unique:posts,slug,' . $this->post, // El Slug debe ser unico, pero ignora el id actual que se está actualizando.
            'category_id'   => 'required|integer',
            'tags'          => 'required|array',
            'body'          => 'required',
            'status'        => 'required|in:DRAFT,PUBLISHED',            
        ];

        if($this->get('file'))   //Adiciona el campo file al array siempre y cuando se envie algo desde el formulario. Si no, no adiciona nada.      
            $rules = array_merge($rules, ['file'=> 'mimes:jpg,png']);

        return $rules;
    }
}