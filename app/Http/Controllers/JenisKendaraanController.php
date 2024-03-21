<?php

namespace App\Http\Controllers;

use App\Models\JenisKendaraan;
use Illuminate\Http\Request;

class JenisKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisKendaraan = JenisKendaraan::get();
        return view('apps.jenis-kendaraan.index', compact('jenisKendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apps.jenis-kendaraan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jenisKendaraan = JenisKendaraan::create($request->all());
        // log activity
        activity()->log('Melakukan Penambahan Data Jenis Kendaraan : ' . $jenisKendaraan->nama);
        toast('Data Jenis Kendaraan '. $jenisKendaraan->nama .' berhasil ditambahkan, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('jenis-kendaraan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisKendaraan $jenisKendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisKendaraan $jenisKendaraan)
    {
        return view('apps.jenis-kendaraan.edit', compact('jenisKendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisKendaraan $jenisKendaraan)
    {
        $jenisKendaraan->update($request->all());
        // log activity
        activity()->log('Melakukan Pembaruan Data Jenis Kendaraan : ' . $jenisKendaraan->nama);
        toast('Data Jenis Kendaraan '. $jenisKendaraan->nama .' berhasil diperbarui, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('jenis-kendaraan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisKendaraan $jenisKendaraan)
    {
        $jenisKendaraan->delete();
        // log activity
        activity()->log('Melakukan Penghapusan Data Jenis Kendaraan : ' . $jenisKendaraan->nama);
        toast('Data Jenis Kendaraan '. $jenisKendaraan->nama .' berhasil dihapus, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('jenis-kendaraan'));
    }
}
