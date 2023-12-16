<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtaRequest extends FormRequest
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
            'descricao' => ['required', 'string', 'max:5000'],
            'data' => ['required', 'date', 'after:01/01/2013'],
        ];
    }

    public function messages()
    {
        return [
            'descricao' => [
                'required' => 'A descrição é obrigatória',
                'max' => 'A descrição pode ter no máximo 5000 caracteres',
            ],
            'data' => [
                'required' => 'A data de início é obrigatória',
                'date' => 'A data de início deve ser uma data válida',
                'after' => 'A data de início deve ser dos últimos 10 anos',
            ],
        ];
    }
}
