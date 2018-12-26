<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\NonSewa;
use App\Models\Sewa;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function addSewaLapangan($id){
        return view('transaksis.tambah_sewa',compact('id'));
    }

    public function simpanSewaLapangan(Request $request){
        $transaksi = Transaksi::find($request->transaksi_id);
        $member = $transaksi->member;
        for ($i=0;$i<count($request->sewa_id);$i++){
            $detail = new DetailTransaksi();
            $detail->sewa_id = $request->sewa_id[$i];
            $detail->tanggal_booking = $request->tanggal_booking[$i];
            $sewa = Sewa::find($request->sewa_id[$i]);
            if ($member->tipe == 1){
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
        return redirect(route('transaksis.show',['id' => $transaksi->id]));
    }

    public function addNonSewaLapangan($id){
        $nonSewa = NonSewa::pluck('nama','id');
        return view('transaksis.tambah_non_sewa',compact('id','nonSewa'));
    }

    public function simpanSewaNonLapangan(Request $request){
//        dd($request->all());
        for ($i=0;$i<count($request->makanan);$i++){
            $detail = new DetailTransaksi();
            $detail->transaksi_id = $request->transaksi_id;
            $detail->non_sewa_id = $request->makanan[$i];
            $detail->jumlah = $request->jumlah[$i];
            $nonSewa = NonSewa::find($request->makanan[$i]);
            $detail->harga = $nonSewa->harga;
            $detail->status = 1;
            $detail->save();
        }
        return redirect(route('transaksis.show',['id' => $request->transaksi_id]));
    }

    public function hapusSewa($id){
        $detail = DetailTransaksi::find($id);
        $id = $detail->transaksi_id;
        $detail->delete();
        return redirect(route('transaksis.show',['id' => $id]));
    }

    public function editNonSewa($id){
        $detail = DetailTransaksi::find($id);
        $nonSewa = NonSewa::pluck('nama','id');
        return view('transaksis.edit_non',compact('detail','nonSewa'));
    }

    public function saveNonSewa($id,Request $request){
        $detail = DetailTransaksi::find($id);
        $detail->update($request->all());
        return redirect(route('transaksis.show',['id' => $detail->transaksi_id]));
    }
}
