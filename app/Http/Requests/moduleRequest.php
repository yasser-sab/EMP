<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class moduleRequest extends FormRequest
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
        return [
            'ref'=>'required',
            'nom'=>'required',
            'abr'=>'required',
            'masse'=>'numeric|required|min:1|max:200',
            'niveau'=>'required',
            'order'=>'required',
        ];
    }
    public function attributes()
    {
        return [
        'ref'=>'refrence',
            'abr'=>'abbreviation',
            'masse'=>'mase horaire',
        ];
    }
}
