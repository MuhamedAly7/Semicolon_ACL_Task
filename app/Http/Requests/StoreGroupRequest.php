<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Only administrators can perform this action.'
        ], 403));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'group_name' => 'required|string|max:255|unique:groups,name'
        ];
    }

    public function messages()
    {
        return [
            'group.required' => 'The group name is required.',
            'group.string' => 'The group name must be a valid string.',
            'group.max' => 'The group name may not be greater than 255 characters.',
            'group.unique' => 'This group name already exists.',
        ];
    }
}
