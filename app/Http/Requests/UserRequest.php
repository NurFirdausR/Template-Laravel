<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
     * @var int|string
     */
    protected $role;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name'         => 'required|string',
            'email'        => 'required|unique:users,email,' . $this->route('user'),
            'telepon'      => 'nullable|numeric',
            'password'     => 'nullable|min:6',
            'role'         => 'required|exists:roles,name',
        ];

        if ($this->role == 'kanwil') {
            $rules['provinsi_id'] = 'required|exists:m_provinsi,id';
        }

        if ($this->role == 'kabko') {
            $rules['provinsi_id'] = 'required|exists:m_provinsi,id';
            $rules['kabupaten_id'] = 'required|exists:m_kabupaten,id';
        }

        return $rules;
    }
}
