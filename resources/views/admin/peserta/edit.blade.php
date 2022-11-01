@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pesertum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.peserta.update", [$pesertum->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama">{{ trans('cruds.pesertum.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $pesertum->nama) }}" required>
                @if($errors->has('nama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pesertum.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="asal_dprd">{{ trans('cruds.pesertum.fields.asal_dprd') }}</label>
                <input class="form-control {{ $errors->has('asal_dprd') ? 'is-invalid' : '' }}" type="text" name="asal_dprd" id="asal_dprd" value="{{ old('asal_dprd', $pesertum->asal_dprd) }}" required>
                @if($errors->has('asal_dprd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('asal_dprd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pesertum.fields.asal_dprd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="angkatan">{{ trans('cruds.pesertum.fields.angkatan') }}</label>
                <input class="form-control {{ $errors->has('angkatan') ? 'is-invalid' : '' }}" type="number" name="angkatan" id="angkatan" value="{{ old('angkatan', $pesertum->angkatan) }}" step="1">
                @if($errors->has('angkatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('angkatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pesertum.fields.angkatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="foto">{{ trans('cruds.pesertum.fields.foto') }}</label>
                <div class="needsclick dropzone {{ $errors->has('foto') ? 'is-invalid' : '' }}" id="foto-dropzone">
                </div>
                @if($errors->has('foto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('foto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pesertum.fields.foto_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.fotoDropzone = {
    url: '{{ route('admin.peserta.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="foto"]').remove()
      $('form').append('<input type="hidden" name="foto" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="foto"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pesertum) && $pesertum->foto)
      var file = {!! json_encode($pesertum->foto) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="foto" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection