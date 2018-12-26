<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\JadwalMember;
use App\Models\Member;
use App\Models\NonSewa;
use App\Models\RiwayatSaldo;
use App\Models\Sewa;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::all();
        return view('transaksis.index',compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = User::where('role',3)->get();
        $member = [];
        foreach ($members as $value){
            $member[$value->member->id] = $value->name;
        }
        $nonSewa = NonSewa::pluck('nama','id');
        return view('transaksis.create',compact('member','nonSewa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for ($i=0;$i<count($request->sewa_id);$i++){
            $detail = DetailTransaksi::where('jadwal_id',$request->sewa_id[$i])->where('tanggal_booking',$request->tanggal_booking[$i])->first();
            if (isset($detail)){
                session()->flash('flash_succes', 'Ada jadwal bentrok');
                return redirect(route('transaksis.create'));
            }
        }
        if ($request->member_id == 1){
            $member = new Member();
            $member->user_id = 2;
            $member->no_hp = $request->no_hp;
            $member->nama = $request->nama;
            $member->save();
        }else{
            $member = Member::find($request->member_id);
        }

        $transaksi = new Transaksi();
        $transaksi->pegawai_id = Auth::user()->id;
        $transaksi->member_id  = $member->id;
        $transaksi->tanggal = Carbon::now();
        $transaksi->status = 2;
        $transaksi->save();

        if (isset($request->sewa_id)){
            for ($i=0;$i<count($request->sewa_id);$i++){
                $detail = new DetailTransaksi();
                $detail->jadwal_id = $request->sewa_id[$i];
                $detail->tanggal_booking = $request->tanggal_booking[$i];
                $sewa = Sewa::find($request->sewa_id[$i]);
                if ($member->tipe == 1 && $member->user_id > 2){
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

        if (isset($request->makanan)){
            for ($i=0;$i<count($request->makanan);$i++){
                $detail = new DetailTransaksi();
                $detail->transaksi_id = $transaksi->id;
                $detail->non_sewa_id = $request->makanan[$i];
                $detail->jumlah = $request->jumlah[$i];
                $nonSewa = NonSewa::find($request->makanan[$i]);
                $detail->harga = $nonSewa->harga;
                $detail->status = 1;
                $detail->save();
            }
        }

        return redirect(route('transaksis.show',['id' => $transaksi->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        return view('transaksis.show',compact('transaksi','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        foreach ($transaksi->detail($id) as $item){
            $item->delete();
        }
        $transaksi->delete();

        return redirect(route('transaksis.index'));
    }

    public function getJadwal($tanggal){
        $x = explode('-',$tanggal);
        $a = Carbon::create($x[0],$x[1],$x[2]);
        $ret = [];
        if ($a >= Carbon::now()){
            $detailTran = DetailTransaksi::where('tanggal_booking',$tanggal)->pluck('jadwal_id')->toArray();
            $sns = Sewa::where('hari',$a->dayOfWeek)->whereNotIn('id',$detailTran)->get();
            foreach ($sns as $sn){
                $as['id'] = $sn->id;
                $as['jam'] = $sn->jam_mulai.'-'.$sn->jam_selesai;
                $ret[] = $as;
            }
        }
        return response()->json($ret);
    }

    public function bayarTunai(Request $request){
        $transaksi = Transaksi::find($request->id);
        $transaksi->status = 3;
        $transaksi->save();
        $this->changeStatus($transaksi);
        session()->flash('flash_succes', 'Pembayaran Berhasil');
        return redirect(route('transaksis.show',['id' => $request->id]));
    }

    public function bayar($id){
        $transaksi = Transaksi::find($id);
        return view('transaksis.bayar_qr',compact('transaksi'));
    }

    public function bayarQR(Request $request){
        $transaksi = Transaksi::find($request->transaksi_id);
        if ($transaksi->member_id != $request->member_id){
            session()->flash('flash_succes', 'Member transaksi tidak sama dengan member yang membayar');
            return redirect(route('transaksis.show',['id' => $request->transaksi_id]));
        }
        $this->changeStatus($transaksi);
        $bayar = 0;
        foreach ($transaksi->sewa($request->transaksi_id) as $item){
            $bayar += $item->harga;
        }

        foreach ($transaksi->nonSewa($request->transaksi_id) as $item){
            $bayar += $item->harga*$item->jumlah;
        }

        $member = Member::find($request->member_id);
        if (isset($member)){
            if ($member->saldo > $bayar){
                $transaksi->status = 3;
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
                return redirect(route('transaksis.show',['id' => $request->transaksi_id]));
            }else{
                session()->flash('flash_succes', 'Saldo Member Tidak Cukup');
                return redirect(route('transaksis.show',['id' => $request->transaksi_id]));
            }
        }else{
            session()->flash('flash_succes', 'QR Code tidak ditemukan');
            return redirect(route('transaksis.show',['id' => $request->transaksi_id]));
        }
    }

    public function changeStatus($transaksi){
        foreach ($transaksi->detail($transaksi->id) as $item){
            $item->status = 3;
            $item->save();
        }
    }

    public function checkin(){
        return view('transaksis.checkin');
    }

    public function checkTransaksi($id){
        $transaksi = Transaksi::find($id);
        if (isset($transaksi)){
            return response()->json('ok');
        }else{
            return response()->json('not found');
        }
    }

    public function printBon($id){
        $transaksi = Transaksi::find($id);
        return view('transaksis.print',compact('transaksi','id'));
    }
}
