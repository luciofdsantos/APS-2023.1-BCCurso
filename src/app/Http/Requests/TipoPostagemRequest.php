<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoPostagemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'unique:tipo_postagem,nome', 'max:255']
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.unique' => 'O nome precisa ser único',
            'nome.max' => 'O tamanho máximo do nome são 255 caracteres',
        ];
    }
}
