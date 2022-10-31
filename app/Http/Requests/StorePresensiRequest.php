<?php

namespace App\Http\Requests;

use App\Models\Presensi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePresensiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('presensi_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'nullable',
            ],
            'status' => [
                'string',
                'nullable',
            ],
            'refer_to' => [
                'string',
                'nullable',
            ],
            'waktu' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
