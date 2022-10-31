<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPesertumRequest;
use App\Http\Requests\StorePesertumRequest;
use App\Http\Requests\UpdatePesertumRequest;
use App\Models\Pesertum;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PesertaController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pesertum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Pesertum::query()->select(sprintf('%s.*', (new Pesertum())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pesertum_show';
                $editGate = 'pesertum_edit';
                $deleteGate = 'pesertum_delete';
                $crudRoutePart = 'peserta';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });
            $table->editColumn('asal_dprd', function ($row) {
                return $row->asal_dprd ? $row->asal_dprd : '';
            });
            $table->editColumn('jenis_kelamin', function ($row) {
                return $row->jenis_kelamin ? $row->jenis_kelamin : '';
            });
            $table->editColumn('nomor_ponsel', function ($row) {
                return $row->nomor_ponsel ? $row->nomor_ponsel : '';
            });
            $table->editColumn('foto', function ($row) {
                if ($photo = $row->foto) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'foto']);

            return $table->make(true);
        }

        return view('admin.peserta.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pesertum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.peserta.create');
    }

    public function store(StorePesertumRequest $request)
    {
        $pesertum = Pesertum::create($request->all());

        if ($request->input('foto', false)) {
            $pesertum->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pesertum->id]);
        }

        return redirect()->route('admin.peserta.index');
    }

    public function edit(Pesertum $pesertum)
    {
        abort_if(Gate::denies('pesertum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.peserta.edit', compact('pesertum'));
    }

    public function update(UpdatePesertumRequest $request, Pesertum $pesertum)
    {
        $pesertum->update($request->all());

        if ($request->input('foto', false)) {
            if (!$pesertum->foto || $request->input('foto') !== $pesertum->foto->file_name) {
                if ($pesertum->foto) {
                    $pesertum->foto->delete();
                }
                $pesertum->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
            }
        } elseif ($pesertum->foto) {
            $pesertum->foto->delete();
        }

        return redirect()->route('admin.peserta.index');
    }

    public function show(Pesertum $pesertum)
    {
        abort_if(Gate::denies('pesertum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.peserta.show', compact('pesertum'));
    }

    public function destroy(Pesertum $pesertum)
    {
        abort_if(Gate::denies('pesertum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pesertum->delete();

        return back();
    }

    public function massDestroy(MassDestroyPesertumRequest $request)
    {
        Pesertum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pesertum_create') && Gate::denies('pesertum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pesertum();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
