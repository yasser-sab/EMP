<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class formateurRequest extends FormRequest
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
            'nom'=>'required|unique:formateurs,nomF',
            'prenom'=>'required',
           'email'=>'required|unique:formateurs,emailF|email',
           'telephone'=>'required|unique:formateurs,telF|Numeric|Digits:10',
           'adresse'=>'required',
        ];
    }
}
