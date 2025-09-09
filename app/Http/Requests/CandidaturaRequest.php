<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidaturaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'program_id' => ['required', 'integer', 'exists:programas,id']
        ];
    }

    public function messages(): array
    {
        return [
            'program_id.exists' => 'O programa selecionado não existe.',
        ];
    }
}
