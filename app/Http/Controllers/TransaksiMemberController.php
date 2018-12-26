<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\NonSewa;
use App\Models\RiwayatSaldo;
use App\Models\Sewa;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiMemberController extends Controller
{
    public function index(){
        $transaksis = Transaksi::where('member_id',Auth::user()->member->id)->get();
        return view('member.transaksi.index',compact('transaksis'));
    }

    public function create(){
        return view('member.transaksi.create');
    }

    public function store(Request $request){
        $transaksi = new Transaksi();
//        $transaksi->pegawai_id = Auth::user()->id;
        $transaksi->member_id  = Auth::user()->member->id;
        $transaksi->tanggal = Carbon::now();
        $transaksi->status = 1;
        $transaksi->save();

        $member = Member::find(Auth::user()->member->id);

        if (isset($request->sewa_id)){
            for ($i=0;$i<count($request->sewa_id);$i++){
                $detail = new DetailTransaksi();
                $detail->jadwal_id = $request->sewa_id[$i];
                $detail->tanggal_booking = $request->tanggal_booking[$i];
                $sewa = Sewa::find($request->sewa_id[$i]);
                if ($member->tipe == 1 && $member->id > 1){
                    $detail->harga = $sewa->member_pelajar;
                }elseif ($member->tipe == 2){
                    $detail->harga = $sewa->member_dewasa;
                }else{
                    if ($request->tipe == 1){
                        $detail->harga = $sewa->non_pelajar;
                    }else{
                        $detail->harga = $sewa->non_dewasa;
                    }
                }
                $detail->status = 2;
                $detail->transaksi_id = $transaksi->id;
                $detail->save();
            }
        }

        return redirect(route('transaksi.index'));
    }

    public function show($id){
        $transaksi = Transaksi::find($id);
        return view('member.transaksi.show',compact('transaksi','id'));
    }

    public function bayar($id){
        $transaksi = Transaksi::find($id);
        $bayar = 0;
        foreach ($transaksi->sewa($id) as $item){
            $bayar += $item->harga;
        }

        $member = Member::find(Auth::user()->member->id);
        if ($member->saldo > $bayar){
            $transaksi->status = 4;
            $transaksi->save();

            $member->saldo = $member->saldo - $bayar;
            $member->save();

            $detail = new RiwayatSaldo();
            $detail->member_id = $member->id;
            $detail->tanggal = Carbon::now();
            $detail->saldo = $bayar;
            $detail->saldo_sekarang = $member->saldo;
            $detail->tipe = 2;
            $detail->save();

            session()->flash('flash_succes', 'Pembayaran Berhasil');
            return redirect(route('transaksi.show',['id' => $id]));
        }else{
            session()->flash('flash_succes', 'Saldo Member Tidak Cukup');
            return redirect(route('transaksi.show',['id' => $id]));
        }
    }
}
