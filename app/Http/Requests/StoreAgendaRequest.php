<?php

namespace App\Http\Requests;

use App\Models\Agenda;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAgendaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('agenda_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
            ],
            'lokasi' => [
                'string',
                'required',
            ],
        ];
    }
}
