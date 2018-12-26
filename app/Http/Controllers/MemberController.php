<?php

namespace App\Http\Controllers;

use App\Models\JadwalMember;
use App\Models\Member;
use App\Models\RiwayatSaldo;
use App\Models\Sewa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelQRCode\Facades\QRCode;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::where('user_id','!=',2)->get();
        return view('members.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('role',3)->pluck('name','id');
//        $jadDetail = JadwalMember::pluck('jadwal_id')->toArray();
//        $jadwals = Sewa::whereNotIn('id',$jadDetail)->get();
//        $jadwal = [];
//        foreach ($jadwals as $value){
//            $jadwal[$value->id] = config('variable.hari')[$value->hari].' ('.$value->jam_mulai.'-'.$value->jam_selesai.')';
//        }
        return view('members.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $cek = JadwalMember::whereIn('jadwal_id',$request->jadwal_id)->first();
//        if (!isset($cek)){
//            if (isset($request->user_id)){
//                $member = Member::create($request->all());
//            }else{
//                $input = $request->all();
//                $input['role'] = 3;
//                $input['password'] = bcrypt($request->password);
//                $user = User::create($input);
//                $input['user_id'] = $user->id;
//                $member = Member::create($input);
//            }
//            session()->flash('flash_succes', 'Member berhasil disimpan');
//
////            foreach ($request->jadwal_id as $item){
////                $jadwal = new JadwalMember();
////                $jadwal->jadwal_id = $item;
////                $jadwal->member_id = $member->id;
////                $jadwal->save();
////            }
//
//            $input['member_id'] = $member->id;
//            $input['saldo'] = $request->saldo;
//            $input['tipe'] = 1;
//            $input['tanggal'] = Carbon::now();
//            RiwayatSaldo::create($input);
//            return redirect(route('members.index'));
//        }else{
//            return redirect(route('members.create'))->withInput($request->all());
//        }

        if (isset($request->user_id)){
            $member = Member::create($request->all());
        }else{
            $input = $request->all();
            $input['role'] = 3;
            $input['password'] = bcrypt($request->password);
            $user = User::create($input);
            $input['user_id'] = $user->id;
            $member = Member::create($input);
        }
        session()->flash('flash_succes', 'Member berhasil disimpan');

        $input['member_id'] = $member->id;
        $input['saldo'] = $request->saldo;
        $input['saldo_sekarang'] = $request->saldo;
        $input['tipe'] = 1;
        $input['tanggal'] = Carbon::now();
        RiwayatSaldo::create($input);
        return redirect(route('members.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return view('members.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        $user = User::where('role',3)->pluck('name','id');
        $jadDetail = JadwalMember::pluck('jadwal_id')->toArray();
        $jadwals = Sewa::whereNotIn('id',$jadDetail)->get();
        $jadwal = [];
        foreach ($jadwals as $value){
            $jadwal[$value->id] = config('variable.hari')[$value->hari].' ('.$value->jam_mulai.'-'.$value->jam_selesai.')';
        }
        return view('members.edit',compact('member','user','jadwal'));
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
        $member = Member::findOrFail($id);
        $member->update($request->all());
        session()->flash('flash_succes', 'Member berhasil disimpan');
        return redirect(route('members.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        foreach($member->transaksis as $transaksi){
            foreach ($transaksi->detail($transaksi->id) as $detailTransaksi){
                $detailTransaksi->delete();
            }
            $transaksi->delete();
        }

        foreach ($member->riwayatSaldos as $saldo){
            $saldo->delete();
        }
        $member->delete();

        session()->flash('flash_succes', 'Member berhasil dihapus');
        return redirect(route('members.index'));
    }

    public function saldo(Request $request){
        $member = Member::find($request->user_id);
        $member->saldo += $request->saldo;
        $member->save();

        return redirect(route('members.show',['id' => $request->user_id]));
    }

    public function cetakKartu($id){
        $member = Member::find($id);
        $qr = QRCode::text("$id")->setOutfile('member/'.$id.'.png')->png();
        return view('members.cetak_kartu',compact('member','qr'));
    }
}
