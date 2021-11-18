<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StageRequest extends FormRequest
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
            'datefin' => 'required|date|after:datedeb',
            'datedeb' => 'required|date|before:datefin'
        ];
    }
    public function attributes()
    {
        return [
        'datefin'=>'date fin',
            'datedeb'=>'date debut',
        ];
    }
}
