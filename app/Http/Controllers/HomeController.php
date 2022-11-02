<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesertum;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use URL;
use Uuid;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
        return view('home');
    }

    public function userData(Pesertum $p, $uuid)
    {
        $p = Pesertum::where('uuid', $uuid)->first();
        return response()->json(['type' => 'success', 'status' => 200, 'data' => $p]);
    }

    public function bulkPdf(Request $request)
    {
        $peserta = Pesertum::orderBy('id', 'desc')->paginate(100);
        $html = '';
        foreach($peserta as $pesertum)
        {
            $uuid = $pesertum->uuid;

            if($uuid == NULL){
                $uuid = Uuid::generate();
                QrCode::size(1020)->generate($uuid, '../public/qrcodes/'.$uuid.'.svg');
                $value['uuid'] = $uuid;
                Pesertum::where('id', $pesertum->id)->update($value);
                $pesertum->uuid = $uuid;
            }

            $view = view('idcard')->with(compact('pesertum'));
            $html .= $view->render();
        }
        return $html; 
    }
    
}
