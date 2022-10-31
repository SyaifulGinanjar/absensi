@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.session.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sessions.update", [$session->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_agenda_id">{{ trans('cruds.session.fields.nama_agenda') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_agenda') ? 'is-invalid' : '' }}" name="nama_agenda_id" id="nama_agenda_id" required>
                    @foreach($nama_agendas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('nama_agenda_id') ? old('nama_agenda_id') : $session->nama_agenda->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_agenda'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_agenda') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.nama_agenda_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_sesi">{{ trans('cruds.session.fields.nama_sesi') }}</label>
                <input class="form-control {{ $errors->has('nama_sesi') ? 'is-invalid' : '' }}" type="text" name="nama_sesi" id="nama_sesi" value="{{ old('nama_sesi', $session->nama_sesi) }}" required>
                @if($errors->has('nama_sesi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_sesi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.nama_sesi_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.session.fields.start_time') }}</label>
                <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $session->start_time) }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.session.fields.end_time') }}</label>
                <input class="form-control datetime {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $session->end_time) }}" required>
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.end_time_helper') }}</span>
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