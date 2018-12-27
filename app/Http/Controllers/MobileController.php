<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Member;
Use Carbon\Carbon;
Use App\Models\Sewa;
Use App\Models\Transaksi;
Use App\Models\DetailTransaksi;

class MobileController extends Controller
{
    public function login($username,$password){
    	$user = User::where('username',$username)->where('status',1)->first();
        $member = Member::where('user_id',$user->id)->first();
        $array = [];
        if ($member) {
	    	$pass_ver = password_verify($password,$user->password);
	    	if ($pass_ver==true) {
		        $array[] = array(
				'user_id'=>$user->id,
				'username'=>$user->username
				);
	    	}
    	}
		return response()->json($array);
	}

	public function profil($id){
		$user = User::where('id',$id)->where('status',1)->first();
		$member = Member::where('user_id',$user->id)->first();
		$array = [];
    	$array[] = array(
		'id'			=>  $member->id,
		'username'		=>	$user->username,
		'nama'	 		=>	$user->name,
		'saldo'			=>	$member->saldo,
    	'no_hp'			=>	$member->no_hp,
        'masa_berlaku'  =>  Carbon::parse($member->masa_berlaku)->format('d-m-Y')
		);
		
    	return response()->json($array);
	}

	public function booking($tanggal){
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

	public function save($member_id,$tgl_booking,$id_jadwal){
        $detail = DetailTransaksi::where('jadwal_id',$id_jadwal)->where('tanggal_booking',$tgl_booking)->first();
        if (isset($detail)){
            return response()->json(['Ada jadwal bentrok gaes']);
        }
		$transaksi = new Transaksi();
        $transaksi->member_id  = $member_id;
        $transaksi->tanggal =$tgl_booking;
        $transaksi->status = 1;
        $transaksi->save();

        $member = Member::find($member_id);

        $detail = new DetailTransaksi();
        $detail->jadwal_id = $id_jadwal;
        $detail->tanggal_booking = $tgl_booking;
        $sewa = Sewa::find($id_jadwal);
        if ($member->tipe == 1 && $member->id > 1){
            $detail->harga = $sewa->member_pelajar;
        }elseif ($member->tipe == 2){
            $detail->harga = $sewa->member_dewasa;
        }else{
            if ($member->tipe == 1){
                $detail->harga = $sewa->non_pelajar;
            }else{
                $detail->harga = $sewa->non_dewasa;
            }
        }
        $detail->status = 2;
        $detail->transaksi_id = $transaksi->id;
        $detail->save();
	}

public function history($id){
		$transaksi = Transaksi::where('member_id',$id)->get();
		$n = 0;
		foreach($transaksi as $t){
			foreach ($t->sewa($t->id) as $key) {
				if (isset($key->jadwal_id)) {
					$detail = DetailTransaksi::where('transaksi_id',$t->id)->first();
					$array[$n]['detail_id'] = $detail->id;
					$array[$n]['id'] = $t->id;
					$array[$n]['tanggal'] = Carbon::parse($t->tanggal)->format('Y-m-d');
					if($t->status == 4){
						$array[$n]['status'] = "Sudah Dibayar";
					}
					elseif($t->status == 1){
						$array[$n]['status'] = "Belum Dibayar";
					}
					$array[$n]['harga'] = $key->harga;
					$array[$n]['jadwal'] = $key->Sewa->jam_mulai.'-'.$key->Sewa->jam_selesai;
					$array[$n]['tipe'] = "Booking Lapangan";
				}
				$n++;
			}
			foreach ($t->nonSewa($t->id) as $key) {
				if (isset($key->non_sewa_id)){
					$detail = DetailTransaksi::where('transaksi_id',$t->id)->first();
					$array[$n]['detail_id'] = $detail->id;
					$array[$n]['id'] = $t->id;
					$array[$n]['tanggal'] = Carbon::parse($t->tanggal)->format('Y-m-d');
					if($t->status == 4){
						$array[$n]['status'] = "Sudah Dibayar";
					}
					elseif($t->status == 1){
						$array[$n]['status'] = "Belum Dibayar";
					}
					$array[$n]['harga'] = $key->harga;
					$array[$n]['barang'] = $key->nonSewa->nama;
					$array[$n]['tipe'] = "Makanan/Minuman";
				}
				$n++;
			}
			
		}
		return response()->json($array);
	}

	public function history_detail($id){
		$detail = DetailTransaksi::where('id',$id)->first();
		$transaksi = Transaksi::where('id',$detail->transaksi_id)->first();
		$n = 0;
		if($detail->non_sewa_id == NULL){
			foreach($transaksi->sewa($detail->transaksi_id) as $item){
				$array = [];
				$array[] = array(
				'sewa'			=>  $item->harga,
				'jadwal'		=>	$item->sewa->jam_mulai.'-'.$item->Sewa->jam_selesai,
				'tanggal'	 	=>	Carbon::parse($item->tanggal_booking)->format('d-m-Y'),
				'barang'		=>  "-",
				'harga'			=>  "-",
				'jumlah'		=>  "-",
				'total'			=>  "-"
				);
			}
		}
		elseif($detail->jadwal_id == NULL){
			foreach($transaksi->nonSewa($detail->transaksi_id) as $item){
				$array = [];
				$array[] = array(
				'barang'		=>  $item->nonSewa->nama,
				'harga'			=>  $item->nonSewa->harga,
				'jumlah'		=>  $item->jumlah,
				'total'			=>  $item->nonSewa->harga*$item->jumlah,
				'sewa'			=>  "-",
				'jadwal'		=>	"-",
				'tanggal'	 	=>	"-"
				);
			}
		}
    	return response()->json($array);
	}
}
