<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'title' => ['required','string','max:255'],
            'message' => ['nullable','string','max:255'],
            'file.*' => ['nullable','file'],
            'folder.*' => ['nullable','file','mimes:zip'],
            'email_to' => ['nullable','email','max:255'],
            'your_email' => ['nullable','email','max:255','exists:users,email'],
        ];
    }
}
