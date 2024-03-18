<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:categories|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama wajib diisi.',
            'name.string' => 'Kolom nama harus berupa teks.',
            'name.unique' => 'Nama sudah digunakan.',
            'name.max' => 'Panjang nama tidak boleh lebih dari :max karakter.',
        ];
    }

    public function failedValidation(validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'validation erros',
            'data' => $validator->errors()
        ]));
    }
}
