<?php

namespace App\Http\Controllers;

use App\Models\ItemInspeksi;
use Illuminate\Http\Request;

class ItemInspeksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemInspeksi = ItemInspeksi::get();
        return view('apps.item-inspeksi.index', compact('itemInspeksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apps.item-inspeksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['name' => strtolower(str_replace(' ', '_', $request->item))]);
        $itemInspeksi = ItemInspeksi::create($request->all());
        // log activity
        activity()->log('Melakukan Penambahan Data Item Inspeksi : ' . $itemInspeksi->item);
        toast('Data Item Inspeksi '. $itemInspeksi->item .' berhasil ditambahkan, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('item-inspeksi'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemInspeksi $itemInspeksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemInspeksi $itemInspeksi)
    {
        return view('apps.item-inspeksi.edit',compact('itemInspeksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemInspeksi $itemInspeksi)
    {
        $request->merge(['name' => strtolower(str_replace(' ', '_', $request->item))]);
        $itemInspeksi->update($request->all());

        // log activity
        activity()->log('Melakukan Pembaruan Data Item Inspeksi : ' . $itemInspeksi->item);
        toast('Data Item Inspeksi '. $itemInspeksi->item .' berhasil diperbarui, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('item-inspeksi'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemInspeksi $itemInspeksi)
    {
        $itemInspeksi->delete();
        // log activity
        activity()->log('Melakukan Penghapusan Data Item Inspeksi : ' . $itemInspeksi->item);
        toast('Data Item Inspeksi '. $itemInspeksi->item .' berhasil dihapus, Terima Kasih.', 'success')->timerProgressBar();
        return redirect(url('item-inspeksi'));
    }
}
