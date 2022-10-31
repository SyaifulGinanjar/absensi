@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.presensi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.presensis.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_sesi_id">{{ trans('cruds.presensi.fields.nama_sesi') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_sesi') ? 'is-invalid' : '' }}" name="nama_sesi_id" id="nama_sesi_id">
                    @foreach($nama_sesis as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_sesi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_sesi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_sesi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presensi.fields.nama_sesi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_peserta_id">{{ trans('cruds.presensi.fields.nama_peserta') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_peserta') ? 'is-invalid' : '' }}" name="nama_peserta_id" id="nama_peserta_id">
                    @foreach($nama_pesertas as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_peserta_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_peserta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_peserta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presensi.fields.nama_peserta_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.presensi.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presensi.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.presensi.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presensi.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="refer_to">{{ trans('cruds.presensi.fields.refer_to') }}</label>
                <input class="form-control {{ $errors->has('refer_to') ? 'is-invalid' : '' }}" type="text" name="refer_to" id="refer_to" value="{{ old('refer_to', '') }}">
                @if($errors->has('refer_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refer_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presensi.fields.refer_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="waktu">{{ trans('cruds.presensi.fields.waktu') }}</label>
                <input class="form-control datetime {{ $errors->has('waktu') ? 'is-invalid' : '' }}" type="text" name="waktu" id="waktu" value="{{ old('waktu') }}">
                @if($errors->has('waktu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('waktu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presensi.fields.waktu_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection