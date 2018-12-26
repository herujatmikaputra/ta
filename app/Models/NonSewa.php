<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class NonSewa
 * @package App\Models
 * @version September 21, 2018, 4:02 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection detailTransaksi
 * @property \Illuminate\Database\Eloquent\Collection transaksi
 * @property string nama
 * @property integer harga
 */
class NonSewa extends Model
{

    public $table = 'non_sewa';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'nama',
        'harga'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'harga' => 'integer'
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
    public function sewas()
    {
        return $this->belongsToMany(\App\Models\Sewa::class, 'detail_transaksi');
    }

    public function detailTransaksis(){
        return $this->hasMany(\App\Models\DetailTransaksi::class);
    }
}
