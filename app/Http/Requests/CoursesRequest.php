<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'valueID'   => ['required', 'exists:currency'],
            'date.from' => ['required', 'date'],
            'date.to'   => ['required', 'date', 'after_or_equal:date.from'],
        ];
    }
}
