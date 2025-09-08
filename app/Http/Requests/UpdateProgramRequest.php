<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'      => ['sometimes', 'string', 'max:255'],
            'status'     => ['sometimes', 'string'],
            'start_date' => ['sometimes', 'date'],
            'end_date'   => ['sometimes', 'date']
        ];
    }
}
