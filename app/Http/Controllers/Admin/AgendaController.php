<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAgendaRequest;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Models\Agenda;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgendaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('agenda_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Agenda::query()->select(sprintf('%s.*', (new Agenda())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'agenda_show';
                $editGate = 'agenda_edit';
                $deleteGate = 'agenda_delete';
                $crudRoutePart = 'agendas';

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
            $table->editColumn('lokasi', function ($row) {
                return $row->lokasi ? $row->lokasi : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.agendas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('agenda_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agendas.create');
    }

    public function store(StoreAgendaRequest $request)
    {
        $agenda = Agenda::create($request->all());

        return redirect()->route('admin.agendas.index');
    }

    public function edit(Agenda $agenda)
    {
        abort_if(Gate::denies('agenda_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agendas.edit', compact('agenda'));
    }

    public function update(UpdateAgendaRequest $request, Agenda $agenda)
    {
        $agenda->update($request->all());

        return redirect()->route('admin.agendas.index');
    }

    public function show(Agenda $agenda)
    {
        abort_if(Gate::denies('agenda_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agendas.show', compact('agenda'));
    }

    public function destroy(Agenda $agenda)
    {
        abort_if(Gate::denies('agenda_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agenda->delete();

        return back();
    }

    public function massDestroy(MassDestroyAgendaRequest $request)
    {
        Agenda::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
