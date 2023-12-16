<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TccRequest extends FormRequest
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
            'titulo' => ['required', 'string',  'max:255'],
            'resumo' => ['required', 'string',  'max:65535'],
            'ano' => ['required', 'integer', 'min:2013'],
            'aluno_id' => ['required', 'integer'],
            'professor_id' => ['required', 'integer'],
            'banca_id' => ['required', 'integer'],
            'status' => ['required', 'integer'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório',
            'max' => 'Este campo pode ter no máximo :max caracteres',
            'min' => 'O valor minimo é :min',
        ];
    }
}
