@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.presensi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.presensis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.presensi.fields.id') }}
                        </th>
                        <td>
                            {{ $presensi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presensi.fields.nama_sesi') }}
                        </th>
                        <td>
                            {{ $presensi->nama_sesi->nama_sesi ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presensi.fields.nama_peserta') }}
                        </th>
                        <td>
                            {{ $presensi->nama_peserta->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presensi.fields.type') }}
                        </th>
                        <td>
                            {{ $presensi->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presensi.fields.status') }}
                        </th>
                        <td>
                            {{ $presensi->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presensi.fields.refer_to') }}
                        </th>
                        <td>
                            {{ $presensi->refer_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presensi.fields.waktu') }}
                        </th>
                        <td>
                            {{ $presensi->waktu }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.presensis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection