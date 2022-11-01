<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPresensiMakanRequest;
use App\Http\Requests\StorePresensiMakanRequest;
use App\Http\Requests\UpdatePresensiMakanRequest;
use App\Models\Pesertum;
use App\Models\PresensiMakan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PresensiMakanController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('presensi_makan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PresensiMakan::with(['peserta'])->select(sprintf('%s.*', (new PresensiMakan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'presensi_makan_show';
                $editGate = 'presensi_makan_edit';
                $deleteGate = 'presensi_makan_delete';
                $crudRoutePart = 'presensi-makans';

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
            $table->addColumn('peserta_nama', function ($row) {
                return $row->peserta ? $row->peserta->nama : '';
            });

            $table->editColumn('peserta.asal_dprd', function ($row) {
                return $row->peserta ? (is_string($row->peserta) ? $row->peserta : $row->peserta->asal_dprd) : '';
            });
            $table->editColumn('peserta.angkatan', function ($row) {
                return $row->peserta ? (is_string($row->peserta) ? $row->peserta : $row->peserta->angkatan) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'peserta']);

            return $table->make(true);
        }

        $peserta = Pesertum::get();

        return view('admin.presensiMakans.index', compact('peserta'));
    }

    public function create()
    {
        abort_if(Gate::denies('presensi_makan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pesertas = Pesertum::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.presensiMakans.create', compact('pesertas'));
    }

    public function store(StorePresensiMakanRequest $request)
    {
        $presensiMakan = PresensiMakan::create($request->all());

        return redirect()->route('admin.presensi-makans.index');
    }

    public function edit(PresensiMakan $presensiMakan)
    {
        abort_if(Gate::denies('presensi_makan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pesertas = Pesertum::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $presensiMakan->load('peserta');

        return view('admin.presensiMakans.edit', compact('pesertas', 'presensiMakan'));
    }

    public function update(UpdatePresensiMakanRequest $request, PresensiMakan $presensiMakan)
    {
        $presensiMakan->update($request->all());

        return redirect()->route('admin.presensi-makans.index');
    }

    public function show(PresensiMakan $presensiMakan)
    {
        abort_if(Gate::denies('presensi_makan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $presensiMakan->load('peserta');

        return view('admin.presensiMakans.show', compact('presensiMakan'));
    }

    public function destroy(PresensiMakan $presensiMakan)
    {
        abort_if(Gate::denies('presensi_makan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $presensiMakan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPresensiMakanRequest $request)
    {
        PresensiMakan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
