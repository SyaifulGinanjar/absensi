<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PresensiResource;
use App\Models\Presensi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PresensiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('presensi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PresensiResource(Presensi::with(['nama_sesi', 'nama_peserta'])->get());
    }

    public function show(Presensi $presensi)
    {
        abort_if(Gate::denies('presensi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PresensiResource($presensi->load(['nama_sesi', 'nama_peserta']));
    }

    public function destroy(Presensi $presensi)
    {
        abort_if(Gate::denies('presensi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $presensi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
