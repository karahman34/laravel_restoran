<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasakanRequest extends FormRequest
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
                    'nama_masakan' => 'required|string|min:3',
                    'harga' => 'required|integer|min:1',
                    'status_masakan' => 'required|string',
                    'kategori' => 'required|string',
                    'image' => 'required|image|mimes:jpeg,jpg,png|max:4096',
                    'deskripsi' => 'required|string'
                ];
                break;
            case 'PUT':
                case 'PATCH':
                    return [
                        'nama_masakan' => 'required|string|min:3',
                        'harga' => 'required|integer|min:1',
                        'status_masakan' => 'required|string',
                        'kategori' => 'required|string',
                        'image' => 'image|mimes:jpeg,jpg,png|max:4096',
                        'deskripsi' => 'required|string'
                    ];
                    break;
        }
    }
}
