<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Transaksi
 * @package App\Models
 * @version September 21, 2018, 4:03 am UTC
 *
 * @property \App\Models\User user
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection detailTransaksi
 * @property date tanggal
 * @property integer status
 * @property integer member_id
 * @property integer pegawai_id
 */
class Transaksi extends Model
{

    public $table = 'transaksi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'tanggal',
        'status',
        'member_id',
        'pegawai_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tanggal' => 'date',
        'status' => 'integer',
        'member_id' => 'integer',
        'pegawai_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function pegawai()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function member()
    {
        return $this->hasOne(\App\Models\Member::class,'id','member_id');
    }

    public function scopeSewa($query,$id){
        return DetailTransaksi::where('transaksi_id',$id)->where('jadwal_id','!=',null)->get();
    }

    public function scopeNonSewa($query,$id){
        return DetailTransaksi::where('transaksi_id',$id)->where('non_sewa_id','!=',null)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function scopeDetail($query,$id)
    {
        return DetailTransaksi::where('transaksi_id',$id)->get();
    }
}
