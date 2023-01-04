<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KecamatanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'provinsi_id' => 'required|exists:m_provinsi,id',
            'kabupaten_id' => 'required|exists:m_kabupaten,id',
            'nama_kecamatan' => 'required'
        ];
    }
}
