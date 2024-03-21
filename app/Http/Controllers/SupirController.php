<?php

namespace App\Http\Controllers;

use App\Models\MasterEntitas;
use App\Models\Supir;
use Illuminate\Http\Request;

class SupirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supir = Supir::get();
        return view('apps.supir.index', compact('supir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entitas = MasterEntitas::get();
        return view('apps.supir.create',compact('entitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supir = Supir::create($request->all());
        // log activity
        activity()->log('Melakukan Penambahan Data Supir : ' . $supir->nama);
        toast('Data Supir '. $supir->nama .' berhasil ditambahkan, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('supir'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Supir $supir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supir $supir)
    {
        $entitas = MasterEntitas::get();
        return view('apps.supir.edit', compact('entitas', 'supir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supir $supir)
    {
        $supir->update($request->all());
        // log activity
        activity()->log('Melakukan Pembaruan Data Supir : ' . $supir->nama);
        toast('Data Supir '. $supir->nama .' berhasil diperbarui, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('supir'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supir $supir)
    {
        $supir->delete();
        // log activity
        activity()->log('Melakukan Hapus Data Mobil : ' . $supir->nama);
        toast('Data Mobil '. $supir->nama .' berhasil dihapus, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('supir'));
    }
}
