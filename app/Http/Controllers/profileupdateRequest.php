<?php

namespace App\Http\Requests;

use App\Models\user;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class profileupdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'], // added
            'last_name' => ['required', 'string', 'max:100'],  // added
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('user')->ignore($this->user()->id),
            ],
        ];
    }
}