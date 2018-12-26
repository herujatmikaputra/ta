<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\RiwayatSaldo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RiwayatSaldoController extends Controller
{
    public function create($id){
        return view('riwayat_saldos.create',compact('id'));
    }

    public function store(Request $request){
        $input = $request->all();
        $input['tanggal'] = Carbon::now();
        $input['member_id'] = $request->user_id;
        $member = Member::find($request->user_id);
        if ($request->tipe == 1){
            $member->saldo += $request->saldo;
        }else{
            $member->saldo -= $request->saldo;
        }
        $member->save();
        $input['saldo_sekarang'] = $member->saldo;
        RiwayatSaldo::create($input);

        return redirect(route('members.show',['id'=>$request->user_id]));
    }
}
