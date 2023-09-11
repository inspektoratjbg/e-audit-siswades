<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerintahPengawasanRequest extends FormRequest
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
            'keterangan_permintaan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tahun.required' => 'Tahun harus di isi',
            'tahun.numeric' => 'Tahun harus di isi angka',
            'instansi.required' => 'Instansi harus di isi',
            'keterangan_permintaan.required' => 'Keterangan harus di isi',

        ];
    }
}
