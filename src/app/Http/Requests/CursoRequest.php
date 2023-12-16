<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
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
            'carga_horaria' => ['required', 'integer', 'gt:0'],
            'nome' => ['required', 'string', 'max:255', 'unique:curso,nome,' . $this->id],
            'sigla' => ['required', 'string', 'max:255', 'unique:curso,sigla, ' . $this->id],
            'turno' => ['required', 'string', 'max:255'],
            'ato_autorizacao' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'horario' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'calendario' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'analytics' => ['nullable', 'string', 'max:255'],
            'nota_in_loco_SINAES' => ['nullable', 'integer','min:1', 'max:5'],
            'nota_enade' => ['nullable', 'integer','min:1', 'max:5'],
        ];
    }

    public function messages()
    {
        return [
            'carga_horaria' => [
                'required' => 'A carga horária é obrigatória',
                'integer' => 'A carga horária é um inteiro',
                'gt' => 'A carga horário deve ser positiva'
            ],
            'nome' => [
                'required' => 'O nome é obrigatório',
                'string' => 'O nome deve conter texto',
                'max' => 'O nome deve ter no máximo 255 caracteres',
                'unique' => 'O nome deve ser único',
            ],
            'sigla' => [
                'required' => 'A sigla é obrigatória',
                'string' => 'A sigla deve conter texto',
                'max' => 'A sigla deve ter no máximo 255 caracteres',
                'unique' => 'A sigla deve ser única',
            ],
            'turno' => [
                'required' => 'O turno é obrigatório',
                'max' => 'O turno deve ter no máximo 255 caracteres',
            ],
            'ato_autorizacao' => [
                'required' => 'O ato de autorização é obrigatório', 
                'file' => 'O ato de autorização deve ser um arquivo', 
                'mimes' => 'O ato de autorização deve ser um PDF', 
                'max'  => 'O ato de autorização deve ter no máximo 10 Mb',
            ],
            'horario' => [
                'file' => 'O horário deve ser um arquivo', 
                'mimes' => 'O horário deve ser um PDF', 
                'max'  => 'O horário deve ter no máximo 10 Mb',
            ],
            'calendario' => [
                'file' => 'O calendário deve ser um arquivo', 
                'mimes' => 'O calendário deve ser um PDF', 
                'max'  => 'O calendário deve ter no máximo 10 Mb',
            ],
            'analytics' => [
                'string' => 'O analytics deve conter texto',
                'max' => 'O analytics deve ter no máximo 255 caracteres',
            ],
            'nota_in_loco_SINAES' => [
                'integer' => 'A nota é um inteiro',
                'min' => 'A nota deve ser no minimo 1',
                'max' => 'A nota deve ser no máximo 5',
            ],
            'nota_enade' => [
                'integer' => 'A nota é um inteiro',
                'min' => 'A nota deve ser no minimo 1',
                'max' => 'A nota deve ser no máximo 5',
            ],
        ];
    }
}
