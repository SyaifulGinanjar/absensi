<?php

namespace App\Http\Requests;

use App\Models\Pesertum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePesertumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pesertum_create');
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
            'angkatan' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
