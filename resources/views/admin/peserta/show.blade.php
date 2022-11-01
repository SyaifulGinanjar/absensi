@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pesertum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.peserta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pesertum.fields.id') }}
                        </th>
                        <td>
                            {{ $pesertum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pesertum.fields.nama') }}
                        </th>
                        <td>
                            {{ $pesertum->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pesertum.fields.asal_dprd') }}
                        </th>
                        <td>
                            {{ $pesertum->asal_dprd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pesertum.fields.angkatan') }}
                        </th>
                        <td>
                            {{ $pesertum->angkatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pesertum.fields.foto') }}
                        </th>
                        <td>
                            @if($pesertum->foto)
                                <a href="{{ $pesertum->foto->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $pesertum->foto->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.peserta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection