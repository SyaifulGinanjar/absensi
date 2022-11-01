<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\PresensiMakan;

class PresensiController extends Controller
{
    //

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $mytime = Carbon::now()->toDateTimeString();
        
        $input = $request->all();
        if($input['type'] == 'room' && $input['status'] == 'checkin' ){
            $data = Presensi::where('type', 'room')->where('nama_peserta_id', $input['nama_peserta_id'])->orderBy('id', 'desc')->first();
            if($data && $data->status != 'checkout'){
                return response()->json(['type' => 'error', 'status' => 500, 'message' => "Anda belum melakukan Check-out"], 500);
            }
            $input['refer_to'] = 0;
        }else if($input['type'] == 'room' && $input['status'] == 'checkout' ){
            $data = Presensi::where('type', 'room')->where('nama_peserta_id', $input['nama_peserta_id'])->orderBy('id', 'desc')->first();
            if(!$data || $data && $data->status != 'checkin'){
                return response()->json(['type' => 'error', 'status' => 500, 'message' => "Anda belum melakukan Check-in"], 500);
            }
            $input['refer_to'] = $data->id;
        }

        $data = Session::whereDateBetween('start_time', $mytime, 'end_time', $mytime )->first();
        $session_id = 0;

        if($data){
            $session_id = $data->id;
        }

        DB::beginTransaction();
        try {
            $input['nama_sesi_id'] = $session_id;
            $input['waktu'] = $mytime;
            $presensi = Presensi::create($input);
            DB::commit();
            return response()->json(['type' => 'success', 'status' => 200, 'message' =>  'Berhasil melakukan presensi']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['type' => 'error', 'status' => 500, 'message' => $th->getMessage()], 500);
        }
    }
    public function storeMakan(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $mytime = Carbon::now()->toDateTimeString();
        $input = $request->all();
        $peserta_id = $input['peserta_id'];

        $data = PresensiMakan::where('peserta_id', $peserta_id)->first();

        if($data){
            return response()->json(['type' => 'error', 'status' => 500, 'message' => "Anda Sudah Makan"], 500);
        }else{

            DB::beginTransaction();
            try {
                $input['waktu'] = $mytime;
                $presensiMakan = PresensiMakan::create($input);
                DB::commit();
                return response()->json(['type' => 'success', 'status' => 200, 'message' =>  'Berhasil melakukan presensi makan']);
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json(['type' => 'error', 'status' => 500, 'message' => $th->getMessage()], 500);
            }
        }
    }
    public function getPresensi(Request $request){
        return Presensi::where('nama_sesi_id', $request->session_id)->orderBy('id', 'desc')->paginate(30);
    }
    public function getCurrentSession(){
        date_default_timezone_set('Asia/Jakarta');
        $mytime = Carbon::now();
        $data = Sessions::whereDateBetween('start_time', $mytime, 'end_time', $mytime )->first();
        return $data;
    }
}
