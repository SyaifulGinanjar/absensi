<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesertum;

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
    
}
