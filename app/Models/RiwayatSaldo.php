<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class RiwayatSaldo
 * @package App\Models
 * @version September 21, 2018, 4:03 am UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection detailTransaksi
 * @property \Illuminate\Database\Eloquent\Collection transaksi
 * @property integer user_id
 * @property date tanggal
 * @property integer saldo
 * @property integer tipe
 */
class RiwayatSaldo extends Model
{

    public $table = 'riwayat_saldo';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'member_id',
        'tanggal',
        'saldo',
        'saldo_sekarang',
        'tipe'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'tanggal' => 'date',
        'saldo' => 'integer',
        'tipe' => 'integer'
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
}
