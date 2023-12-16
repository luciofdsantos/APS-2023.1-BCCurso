<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoRequest extends FormRequest
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
            'descricao' => ['required', 'string', 'max:65535'],
            'resultados' => ['nullable', 'string',  'max:65535'],
            'data_inicio' => ['required', 'date', 'after:01/01/2013'],
            'data_termino' => ['nullable', 'date', 'after:data_inicio', 'before:+10 years'],
            'palavras_chave' => ['required', 'string',  'max:65535'],
            'professor_id' => ['required', 'integer'],
            'fomento' => ['nullable', 'string',  'max:255'],
            'link' => ['nullable', 'url', 'max:255'],
            'imagens.*' => ['image']
        ];
    }

    public function messages()
    {
        return [
            'titulo' => [
                'required' => 'O título é obrigatório',
                'max' => 'O título pode ter no máximo 255 caracteres',
            ],
            'descricao' => [
                'required' => 'A descrição é obrigatória',
                'max' => 'A descrição pode ter no máximo 65535 caracteres',
            ],
            'resultados' => [
                'string' => 'Os resultados devem conter texto',
                'max' => 'Os resultados podem ter no máximo 65535 caracteres',
            ],
            'data_inicio' => [
                'required' => 'A data de início é obrigatória',
                'date' => 'A data de início deve ser uma data válida',
                'after' => 'A data de início deve ser dos últimos 10 anos',
            ],
            'data_termino' => [
                'date' => 'A data de término deve ser uma data válida',
                'after' => 'A data de término não pode ser antes da data de início',
                'before' => 'A data de término não pode passar dos próximos 10 anos',
            ],
            'palavras_chave' => [
                'required' => 'As palavras chave são obrigatórias',
                'max' => 'As palavras chaves devem conter no máximo 65535 caracteres',
            ],
            'professor_id' => [
                'required' => 'Um professor responsável é obrigatório',
            ],
            'fomento' => [
                'max' => 'O fomento deve ter no máximo 255 caracteres',
            ],
            'link' => [
                'url' => 'O link deve conter uma URL válida',
                'max' => 'O link deve ter no máximo 255 caracteres',
            ],
            'imagens.*' => [
                'image' => 'Apenas imagens podem ser enviadas'
            ],
        ];
    }
}
