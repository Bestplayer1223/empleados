<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmpleadoRequest extends FormRequest
{

    /**
     *  return the request response when something gets wrong
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Failed to create or update Worker.',
            'errors' => $errors,
        ], 422));
    }

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
        $rules = [
            'nombre' => 'required|string|min:4',
            'email' => 'required|string|email|max:255',
            'sexo' => 'required|string|max:1',
            'boletin' => 'string|max:1',
            'area_id' => 'required|integer',
            'descripcion' => 'required|string|min:5',
            'roles_id' => 'required|array|min:1'
        ];
        return $rules;
    }
}
