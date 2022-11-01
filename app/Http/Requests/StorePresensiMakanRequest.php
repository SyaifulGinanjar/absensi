<?php

namespace App\Http\Requests;

use App\Models\PresensiMakan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePresensiMakanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('presensi_makan_create');
    }

    public function rules()
    {
        return [
            'peserta_id' => [
                'required',
                'integer',
            ],
            'waktu' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
