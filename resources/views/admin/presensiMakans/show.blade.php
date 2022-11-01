@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.presensiMakan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.presensi-makans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.presensiMakan.fields.id') }}
                        </th>
                        <td>
                            {{ $presensiMakan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presensiMakan.fields.peserta') }}
                        </th>
                        <td>
                            {{ $presensiMakan->peserta->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presensiMakan.fields.waktu') }}
                        </th>
                        <td>
                            {{ $presensiMakan->waktu }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.presensi-makans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection