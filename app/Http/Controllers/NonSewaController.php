<?php

namespace App\Http\Controllers;

use App\Models\NonSewa;
use Illuminate\Http\Request;

class NonSewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nonSewas = NonSewa::all();
        return view('non_sewas.index',compact('nonSewas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('non_sewas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nonSewa = NonSewa::create($request->all());
        session()->flash('flash_succes', 'Harga berhasil disimpan');
        return redirect(route('nonSewas.index'));
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
        $nonSewa = NonSewa::find($id);
        return view('non_sewas.edit',compact('nonSewa'));
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
        $nonSewa = NonSewa::findOrFail($id);
        $nonSewa->update($request->all());
        session()->flash('flash_succes', 'Harga berhasil disimpan');
        return redirect(route('nonSewas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = NonSewa::find($id);
        foreach ($jadwal->detailTransaksis as $detailTransaksi){
            $detailTransaksi->delete();
        }
        $jadwal->delete();

        session()->flash('flash_succes', 'Harga berhasil dihapus');
        return redirect(route('nonSewas.index'));
    }
}
