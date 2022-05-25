<?php

namespace App\Http\Requests\Categories;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;

class NewCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name'      => 'required|string',
            'parent_id' => 'nullable|exists:categories,id',
            'weight'    => 'integer'
        ];
    }

    public function persist($id = null){
        $categoryInsert = (is_null($id)) ? new Category : Category::findOrFail($id);
        
        $categoryInsert->name = $this->name;
        $categoryInsert->parent_id = $this->parent_id;
        $categoryInsert->weight = $this->weight;
        $categoryInsert->save();
    }
}
