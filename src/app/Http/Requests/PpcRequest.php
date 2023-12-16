<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PpcRequest extends FormRequest
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
            'ppc' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'matriz_curricular' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ];
    }

    public function messages()
    {
        return [
            'ppc' => [
                'file' => 'O ppc deve ser um arquivo', 
                'mimes' => 'O ppc deve ser um PDF', 
                'max'  => 'O ppc deve ter no máximo 10 Mb',
            ],
            'matriz_curricular' => [
                'file' => 'A matriz curricular deve ser um arquivo', 
                'mimes' => 'A matriz curricular deve ser um PDF', 
                'max'  => 'A matriz curricular deve ter no máximo 10 Mb',
            ],
        ];
    }
}
