<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
        if ($this->isMethod('PUT')) {
            return [
                'name' => 'required',
                'email' => 'required', Rule::unique('users')->ignore($this->user->id),
                'cellphone' => 'required'
            ];
        }
        if ($this->isMethod('POST')) {
            return [
                'name' => 'required',
                'email' => 'required|unique:users',
                'cellphone' => 'required'
            ];
        }
    }
}
