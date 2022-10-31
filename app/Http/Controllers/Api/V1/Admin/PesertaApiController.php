<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePesertumRequest;
use App\Http\Requests\UpdatePesertumRequest;
use App\Http\Resources\Admin\PesertumResource;
use App\Models\Pesertum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PesertaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pesertum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PesertumResource(Pesertum::all());
    }

    public function store(StorePesertumRequest $request)
    {
        $pesertum = Pesertum::create($request->all());

        if ($request->input('foto', false)) {
            $pesertum->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
        }

        return (new PesertumResource($pesertum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pesertum $pesertum)
    {
        abort_if(Gate::denies('pesertum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PesertumResource($pesertum);
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

        return (new PesertumResource($pesertum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pesertum $pesertum)
    {
        abort_if(Gate::denies('pesertum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pesertum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
