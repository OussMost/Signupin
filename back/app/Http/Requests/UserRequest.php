<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nomfamille' => "required|string|max:255",
            'prenom' => "required|string|max:255",
            'type' => "required|string|max:255",
            'ice' => "max:255",
            'societe' => "string|max:255",
            'email' => "email|required|max:255",
            'password' => "required|string|confirmed|min:8|max:255",
        ];
    }
    public function messages()
    {
        return [
            'nomfamille.required' => 'First name required ! ',
            'prenom.required' => 'Last name required !',
            'email.email' => 'email must be mail form',
        ];
    }
    public function failedValidation(Validator $validator , $code=400)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ],
                $code
            )
        );
    }
}
