<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPresensiRequest;
use App\Models\Pesertum;
use App\Models\Presensi;
use App\Models\Session;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PresensiController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('presensi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Presensi::with(['nama_sesi', 'nama_peserta'])->select(sprintf('%s.*', (new Presensi())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'presensi_show';
                $editGate = 'presensi_edit';
                $deleteGate = 'presensi_delete';
                $crudRoutePart = 'presensis';

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
            $table->addColumn('nama_sesi_nama_sesi', function ($row) {
                return $row->nama_sesi ? $row->nama_sesi->nama_sesi : '';
            });

            $table->addColumn('nama_peserta_nama', function ($row) {
                return $row->nama_peserta ? $row->nama_peserta->nama : '';
            });

            $table->editColumn('nama_peserta.asal_dprd', function ($row) {
                return $row->nama_peserta ? (is_string($row->nama_peserta) ? $row->nama_peserta : $row->nama_peserta->asal_dprd) : '';
            });
            $table->editColumn('nama_peserta.uuid', function ($row) {
                return $row->nama_peserta ? (is_string($row->nama_peserta) ? $row->nama_peserta : $row->nama_peserta->uuid) : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_sesi', 'nama_peserta']);

            return $table->make(true);
        }

        $sessions = Session::get();
        $peserta  = Pesertum::get();

        return view('admin.presensis.index', compact('sessions', 'peserta'));
    }

    public function show(Presensi $presensi)
    {
        abort_if(Gate::denies('presensi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $presensi->load('nama_sesi', 'nama_peserta');

        return view('admin.presensis.show', compact('presensi'));
    }

    public function destroy(Presensi $presensi)
    {
        abort_if(Gate::denies('presensi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $presensi->delete();

        return back();
    }

    public function massDestroy(MassDestroyPresensiRequest $request)
    {
        Presensi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
