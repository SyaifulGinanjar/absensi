<?php

namespace App\Http\Requests;

use App\Models\Pesertum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePesertumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pesertum_edit');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
            ],
            'asal_dprd' => [
                'string',
                'required',
            ],
            'jenis_kelamin' => [
                'string',
                'nullable',
            ],
            'nomor_ponsel' => [
                'string',
                'nullable',
            ],
        ];
    }
}
