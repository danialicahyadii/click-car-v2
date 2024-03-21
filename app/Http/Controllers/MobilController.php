<?php

namespace App\Http\Controllers;

use App\Models\JenisKendaraan;
use App\Models\MasterDriver;
use App\Models\MasterEntitas;
use App\Models\MasterStatus;
use App\Models\Mobil;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mobil = Mobil::orderBy('updated_at', 'desc')->get();
        return view('apps.mobil.index', compact('mobil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plats = Plat::get();
        $jenis_kendaraan = JenisKendaraan::get();
        $status = MasterStatus::whereBetween('id', [8, 11])->orderBy('updated_at', 'DESC')->get();
        $supir = MasterDriver::where('id_entitas', Auth::user()->id_entitas)->where('id_status', 1)->get();
        $entitas = MasterEntitas::get();

        return view('apps.mobil.create', compact('plats', 'jenis_kendaraan', 'status', 'supir', 'entitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mobil = Mobil::create($request->all());
        // log activity
        activity()->log('Melakukan Penambahan Data Mobil : ' . $mobil->nama);
        toast('Data Mobil '. $mobil->nama .' berhasil ditambahkan, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('mobil'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Mobil $mobil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mobil $mobil)
    {
        $plats = Plat::get();
        $jenis_kendaraan = JenisKendaraan::get();
        $status = MasterStatus::whereBetween('id', [8, 11])->orderBy('updated_at', 'DESC')->get();
        $supir = MasterDriver::where('id_entitas', Auth::user()->id_entitas)->where('id_status', 1)->get();
        $entitas = MasterEntitas::get();
        return view('apps.mobil.edit', compact('mobil', 'plats', 'jenis_kendaraan', 'status', 'supir', 'entitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mobil $mobil)
    {
        $mobil->update($request->all());
        // log activity
        activity()->log('Melakukan Pembaruan Data Mobil : ' . $mobil->nama);
        toast('Data Mobil '. $mobil->nama .' berhasil diperbarui, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('mobil'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobil $mobil)
    {
        $mobil->delete();
        // log activity
        activity()->log('Melakukan Hapus Data Mobil : ' . $mobil->nama);
        toast('Data Mobil '. $mobil->nama .' berhasil dihapus, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('mobil'));
    }
}
