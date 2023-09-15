<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'attribute_id' => 'required|integer|exists:attributes,id'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => __('failed_messages.attribute.value.name.required'),
            'name.max' => __('failed_messages.attribute.value.name.max'),
        ];
    }
}
