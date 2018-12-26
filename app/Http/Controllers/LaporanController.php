<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(){
        $year = Carbon::now()->year;
        for($i = $year-10; $i< $year+10;$i++){
            $years[$i] = $i;
        }
        return view('laporan.index',compact('years'));
    }

    public function getLaporan($bulan,$tahun){
        $transaksis = Transaksi::whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->where('status',3)->get();
        $ret = [];
        $no = 1;
        foreach ($transaksis as $transaksi){
            $a = [];
            $a['no'] = $no++;
            $a['tanggal'] = $transaksi->tanggal->format('d-m-Y');
            if ($transaksi->member->user_id != 2){
                $a['pelanggan'] = $transaksi->member->user->name;
            }else{
                $a['pelanggan'] = $transaksi->member->nama;
            }
            $total = 0;
            foreach ($transaksi->detail($transaksi->id) as $item){
                if ($item->jumlah == 0){
                    $total += $item->harga;
                }else{
                    $total += $item->harga * $item->jumlah;
                }
            }
            $a['total'] = $total;
            $ret['data'][] = $a;
        }

        if (!isset($ret['data'])){
            $a = [];
            $a['no'] = '';
            $a['tanggal'] = 'Data Belum';
            $a['pelanggan'] = 'Ada';
            $a['total'] = '';
            $ret['data'][] = $a;
        }

        return response()->json($ret);
    }

    public function printLaporan($bulan,$tahun){
        $transaksis = Transaksi::whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->where('status',3)->get();
        return view('laporan.print',compact('transaksis','bulan'));
    }
}
