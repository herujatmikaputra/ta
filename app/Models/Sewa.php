<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Sewa
 * @package App\Models
 * @version September 21, 2018, 4:02 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection detailTransaksi
 * @property \Illuminate\Database\Eloquent\Collection transaksi
 * @property integer hari
 * @property time jam_mulai
 * @property time jam_selesai
 * @property integer member_pelajar
 * @property integer member_dewasa
 * @property integer non_pelajar
 * @property integer non_dewasa
 */
class Sewa extends Model
{

    public $table = 'jadwal';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'member_pelajar',
        'member_dewasa',
        'non_pelajar',
        'non_dewasa'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'hari' => 'integer',
        'member_pelajar' => 'integer',
        'member_dewasa' => 'integer',
        'non_pelajar' => 'integer',
        'non_dewasa' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function nonSewas()
    {
        return $this->belongsToMany(\App\Models\NonSewa::class, 'detail_transaksi');
    }

    public function detailTransaksis(){
        return $this->hasMany(\App\Models\DetailTransaksi::class,'id','jadwal_id');
    }
}
