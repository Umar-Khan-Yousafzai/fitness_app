<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Carbon\Carbon;

class FootStepStoreRequest extends FormRequest
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
            'stepsCount' => 'required',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => [
                'required',
                'date_format:Y-m-d H:i:s',
                function ($attribute, $value, $fail) {
                    $start = Carbon::parse($this->input('start_time'));
                    $end = Carbon::parse($value);
                    if (!$end->isAfter($start) || !$end->isSameDay($start)) {
                        $fail('The end time must be greater than the start time and on the same day.');
                    }
                },
            ],
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
