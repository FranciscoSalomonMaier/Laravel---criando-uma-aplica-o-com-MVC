<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true; //todos são autorizados a usar essa validação
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'min:3']
        ];
    }

    public function messages()
    {
        return [
            'nome.*' => 'O campo nome é obrigatório e o campo nome precisa de pelo menos 3 carácteres'
        ];
        // return [
        //     'nome.required' => 'O campo nome é obrigatório',
        //     'nome.min' => 'O campo nome precisa de pelo menos :min carácteres'
        // ];
    }

}
