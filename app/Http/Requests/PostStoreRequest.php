<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'slug'          => 'required|unique:posts,slug',
            'category_id'   => 'required|integer',
            'tags'          => 'required|array',
            'body'          => 'required',
            'status'        => 'required|in:DRAFT,PUBLISHED',            
        ];
        
        if($this->get('file'))   //Adiciona el campo file al array siempre y cuando se envie algo desde el formulario. Si no, no adiciona nada.      
            $rules = array_merge($rules, ['file'=> 'mimes:jpg,png,svg']);
        
        if($this->get('image'))   //Adiciona el campo image al array siempre y cuando se envie algo desde el formulario. Si no, no adiciona nada.      
            $rules = array_merge($rules, ['image'=> 'mimes:jpg,png,svg']); 
        return $rules;
    }
}