<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('members', 'MemberController');
Route::post('members/saldo/save', 'MemberController@saldo')->name('members.saldo');
Route::get('cetakKartu/{id}', 'MemberController@cetakKartu')->name('members.cetakMember');

Route::resource('sewas', 'SewaController');

Route::resource('nonSewas', 'NonSewaController');

//Route::resource('jadwalMembers', 'JadwalMemberController');

Route::resource('riwayatSaldos', 'RiwayatSaldoController');
Route::get('riwayatSaldos/creates/{id}', 'RiwayatSaldoController@create')->name('riwayatSaldos.creates');

Route::resource('transaksis', 'TransaksiController');
Route::get('getJadwal/{tanggal}', 'TransaksiController@getJadwal')->name('getJadwal');
Route::get('transaksi/bayar/{id}', 'TransaksiController@bayar')->name('bayar');
Route::post('transaksi/bayar/tunai', 'TransaksiController@bayarTunai')->name('transaksis.tunai');
Route::get('checkin', 'TransaksiController@checkin')->name('transaksis.checkin');
Route::get('checkTransaksi/{id}', 'TransaksiController@checkTransaksi')->name('transaksis.checkTransaksi');
Route::get('printBon/{id}', 'TransaksiController@printBon')->name('printBon');

Route::resource('detailTransaksis', 'DetailTransaksiController');
Route::get('addSewaLapangan/{id}', 'DetailTransaksiController@addSewaLapangan')->name('addSewaLapangan');
Route::post('simpanSewaLapangan', 'DetailTransaksiController@simpanSewaLapangan')->name('simpanSewaLapangan');
Route::get('addNonSewaLapangan/{id}', 'DetailTransaksiController@addNonSewaLapangan')->name('addNonSewaLapangan');
Route::post('simpanSewaNonLapangan', 'DetailTransaksiController@simpanSewaNonLapangan')->name('simpanSewaNonLapangan');
Route::get('hapusSewa/{id}', 'DetailTransaksiController@hapusSewa')->name('hapusSewa');
Route::get('editNonSewa/{id}', 'DetailTransaksiController@editNonSewa')->name('editNonSewa');
Route::patch('saveNonSewa/{id}/', 'DetailTransaksiController@saveNonSewa')->name('saveNonSewa');
Route::get('transaksis/bayar/{id}', 'TransaksiController@bayar')->name('bayar');
Route::post('bayar/qrcode', 'TransaksiController@bayarQR')->name('bayar.qr');
Route::get('laporan', 'LaporanController@index')->name('laporan.index');
Route::get('getLaporan/{bulan}/{tahun}', 'LaporanController@getLaporan')->name('laporan.getLaporan');
Route::get('print/laporan/{bulan}/{tahun}', 'LaporanController@printLaporan')->name('laporan.printLaporan');

Route::prefix('member')->group(function (){
    Route::resource('transaksi', 'TransaksiMemberController');
    Route::get('bayar/{id}', 'TransaksiMemberController@bayar')->name('member.bayar');
    Route::get('tolak/{id}', 'TransaksiMemberController@tolak')->name('member.tolak');
    Route::get('profile', 'ProfileMemberController@profile')->name('member.profile');
});

Route::prefix('mobile')->group(function (){
    Route::get('login/{username}/{password}', 'MobileController@login');
    Route::get('profil/{id}','MobileController@profil');
    Route::get('history/{id}','MobileController@history');
    Route::get('history_detail/{id}','MobileController@history_detail');
    Route::get('booking/{tanggal}','MobileController@booking');
    Route::get('save/{member_id}/{tgl_booking}/{id_jadwal}','MobileController@save');
});

Route::post('pull', function(){
    $cmd = 'cd ../ && git pull origin master';
    $output = shell_exec($cmd);
    
    return $output;
});