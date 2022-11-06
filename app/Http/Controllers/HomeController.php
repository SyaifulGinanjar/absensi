<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesertum;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use URL;
use Uuid;
use Illuminate\Support\Facades\Auth;

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

        if(isset($request->angkatan)){
            $peserta = Pesertum::where('angkatan', $request->angkatan)->orderBy('id', 'asc')->paginate(100);
        }else{
            $peserta = Pesertum::orderBy('id', 'asc')->paginate(100);
        }

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
    
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // The user is active, not suspended, and exists.
            $user = User::where('email', $request->email)->first();
            return response()->json(['type' => 'success', 'status' => 200, 'data' => $user ]);
        }else{
            return response()->json(['type' => 'error', 'status' => 401, 'data' => null ]);
        }
    }
}
