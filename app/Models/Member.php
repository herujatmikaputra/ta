<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Member
 * @package App\Models
 * @version September 21, 2018, 4:01 am UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection detailTransaksi
 * @property \Illuminate\Database\Eloquent\Collection transaksi
 * @property date tanggal_lahir
 * @property integer tipe
 * @property integer saldo
 * @property string no_hp
 */
class Member extends Model
{

    public $table = 'member';
//    public $primaryKey = 'user_id';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'id',
        'user_id',
        'tanggal_lahir',
        'tipe',
        'saldo',
        'no_hp',
        'masa_berlaku',
        'nama'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'tanggal_lahir' => 'date',
        'masa_berlaku' => 'date',
        'tipe' => 'integer',
        'saldo' => 'integer',
        'no_hp' => 'string'
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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function riwayatSaldos()
    {
        return $this->hasMany(\App\Models\RiwayatSaldo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function jadwalMember()
    {
        return $this->hasMany(\App\Models\JadwalMember::class);
    }

    public function transaksis()
    {
        return $this->hasMany(\App\Models\Transaksi::class);
    }
}
