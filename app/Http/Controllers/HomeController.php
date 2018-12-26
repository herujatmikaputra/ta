<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = User::where('role',3)->count();
        $transaksi = Transaksi::whereIn('status',[1,2,4])->count();
        return view('home',compact('member','transaksi'));
    }
}
