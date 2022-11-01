<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePresensiMakanRequest;
use App\Http\Requests\UpdatePresensiMakanRequest;
use App\Http\Resources\Admin\PresensiMakanResource;
use App\Models\PresensiMakan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PresensiMakanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('presensi_makan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PresensiMakanResource(PresensiMakan::with(['peserta'])->get());
    }

    public function store(StorePresensiMakanRequest $request)
    {
        $presensiMakan = PresensiMakan::create($request->all());

        return (new PresensiMakanResource($presensiMakan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PresensiMakan $presensiMakan)
    {
        abort_if(Gate::denies('presensi_makan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PresensiMakanResource($presensiMakan->load(['peserta']));
    }

    public function update(UpdatePresensiMakanRequest $request, PresensiMakan $presensiMakan)
    {
        $presensiMakan->update($request->all());

        return (new PresensiMakanResource($presensiMakan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PresensiMakan $presensiMakan)
    {
        abort_if(Gate::denies('presensi_makan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $presensiMakan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
