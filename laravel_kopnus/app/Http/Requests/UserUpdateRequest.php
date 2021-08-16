<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => [
                'required',
                'unique:App\Models\User,email,'.$this->id
            ],
            'phone' => [
                'required',
                'unique:App\Models\User,phone,'.$this->id
            ],
            'address' => 'required|max:255',
        ];
    }
}
