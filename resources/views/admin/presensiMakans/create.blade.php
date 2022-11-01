@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.presensiMakan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.presensi-makans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="peserta_id">{{ trans('cruds.presensiMakan.fields.peserta') }}</label>
                <select class="form-control select2 {{ $errors->has('peserta') ? 'is-invalid' : '' }}" name="peserta_id" id="peserta_id" required>
                    @foreach($pesertas as $id => $entry)
                        <option value="{{ $id }}" {{ old('peserta_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('peserta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('peserta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presensiMakan.fields.peserta_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="waktu">{{ trans('cruds.presensiMakan.fields.waktu') }}</label>
                <input class="form-control datetime {{ $errors->has('waktu') ? 'is-invalid' : '' }}" type="text" name="waktu" id="waktu" value="{{ old('waktu') }}" required>
                @if($errors->has('waktu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('waktu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presensiMakan.fields.waktu_helper') }}</span>
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