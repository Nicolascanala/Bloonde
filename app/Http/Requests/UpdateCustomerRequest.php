<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $customer = $this->route('customer');
        return auth()->user()->profile_id === 1 || auth()->id() == $customer->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'surname' => ['sometimes', 'string', 'max:255'],
            'user_id' => ['sometimes', 'integer', 'exists:users,id'],
            'hobbies' => ['sometimes', 'array'],
            'hobbies.*' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
