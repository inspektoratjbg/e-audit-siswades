<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembinaanRequest extends FormRequest
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
            'tahun' => 'required|numeric|digits:4',
            'kd_desa' => 'required',
            'jumlah' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'tahun.required' => 'Tahun harus di isi',
            'tahun.numeric' => 'Tahun harus di isi angka',
            'jumlah.required' => 'Faktor Resiko harus di isi',
            'jumlah.numeric' => 'Faktor Resiko harus di isi angka',
            'kd_desa.required' => 'Desa harus di isi'

        ];
    }
}
