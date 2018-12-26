<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class DetailTransaksi
 * @package App\Models
 * @version September 21, 2018, 4:05 am UTC
 *
 * @property \App\Models\NonSewa nonSewa
 * @property \App\Models\Sewa sewa
 * @property \Illuminate\Database\Eloquent\Collection transaksi
 * @property integer sewa_id
 * @property integer non_sewa_id
 * @property integer harga
 * @property date tanggal_booking
 */
class DetailTransaksi extends Model
{

    public $table = 'detail_transaksi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'jadwal_id',
        'non_sewa_id',
        'harga',
        'tanggal_booking',
        'jumlah'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'jadwal_id' => 'integer',
        'non_sewa_id' => 'integer',
        'harga' => 'integer',
        'tanggal_booking' => 'date',
        'jumlah' => 'integer'
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
    public function nonSewa()
    {
        return $this->belongsTo(\App\Models\NonSewa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function sewa()
    {
        return $this->hasOne(\App\Models\Sewa::class,'id','jadwal_id');
    }
}
