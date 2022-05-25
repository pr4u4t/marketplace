<?php

namespace Modules\MultiCurrency\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeCurrency extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            //
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }
}
