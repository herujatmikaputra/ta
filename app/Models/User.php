<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class User
 * @package App\Models
 * @version September 21, 2018, 3:59 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection detailTransaksi
 * @property \Illuminate\Database\Eloquent\Collection JadwalMember
 * @property \App\Models\Member member
 * @property \Illuminate\Database\Eloquent\Collection RiwayatSaldo
 * @property \Illuminate\Database\Eloquent\Collection Transaksi
 * @property \Illuminate\Database\Eloquent\Collection Transaksi
 * @property string name
 * @property string username
 * @property string password
 * @property integer role
 * @property integer status
 * @property string remember_token
 */
class User extends Model
{

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'username',
        'password',
        'role',
        'status',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'username' => 'string',
        'password' => 'string',
        'role' => 'integer',
        'status' => 'integer',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function jadwalMembers()
    {
        return $this->hasMany(\App\Models\JadwalMember::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function member()
    {
        return $this->hasOne(\App\Models\Member::class,'user_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function transaksis()
    {
        return $this->hasMany(\App\Models\Transaksi::class);
    }

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     **/
//    public function transaksis()
//    {
//        return $this->hasMany(\App\Models\Transaksi::class);
//    }
}
