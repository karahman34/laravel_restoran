<?php

namespace App\Http\Requests;

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
        switch($this->method()){
            case 'POST':
                return [
                    'nama_user' => 'required|string',
                    'username' => 'required|string|min:5|unique:users,username',
                    'password' => 'required|string|confirmed',
                    'roles' => 'required',
                    'roles.*' => 'string',
                    'avatar' => 'required|image|mimes:jpeg,jpg,png',
                ];
                break;
            case 'PUT':
                case 'PATCH':
                    return [
                        'nama_user' => 'required|string',
                        'username' => 'required|string|min:5|unique:users,username,'.$this->user->id,
                        'password' => 'confirmed',
                        'roles' => 'required',
                        'roles.*' => 'string',
                        'avatar' => 'image|mimes:jpeg,jpg,png',
                    ];
                    break;
        }
    }
}
