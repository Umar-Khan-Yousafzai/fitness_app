<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->createErrorResponse($validator));
    }

    // Create error response
    private function createErrorResponse($validator)
    {
        return response()->json([
            'status' => false,
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422);
    }
}
