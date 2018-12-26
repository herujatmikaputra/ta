<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sewas = Sewa::all();
        return view('sewas.index',compact('sewas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sewas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sewa = Sewa::create($request->all());
        session()->flash('flash_succes', 'Jadwal berhasil disimpan');
        return redirect(route('sewas.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sewa = Sewa::find($id);
        return view('sewas.edit',compact('sewa'));
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
        $sewa = Sewa::findOrFail($id);
        $sewa->update($request->all());
        session()->flash('flash_succes', 'Jadwal berhasil disimpan');
        return redirect(route('sewas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Sewa::find($id);
        foreach ($jadwal->detailTransaksis as $detailTransaksi){
            $detailTransaksi->delete();
        }
        $jadwal->delete();

        session()->flash('flash_succes', 'Jadwal berhasil dihapus');
        return redirect(route('sewas.index'));
    }
}
