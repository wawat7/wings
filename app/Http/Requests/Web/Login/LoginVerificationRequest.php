<?php

namespace App\Http\Requests\Web\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginVerificationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => "required|string|min:3",
            'password' => "required|string"
        ];
    }
}
