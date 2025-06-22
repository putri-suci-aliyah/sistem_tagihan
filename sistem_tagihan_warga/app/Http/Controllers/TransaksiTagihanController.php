<?php

namespace App\Http\Controllers;

use App\Models\penduduk;
use App\Models\Tagihan;
use App\Models\TransaksiTagihan;
use Illuminate\Http\Request;

class TransaksiTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.transaksi_tagihan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penduduk = penduduk::all();
        $tagihan = Tagihan::all();
        return view('pages.transaksi_tagihan.create',compact('penduduk','tagihan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TransaksiTagihan $transaksiTagihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiTagihan $transaksiTagihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransaksiTagihan $transaksiTagihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiTagihan $transaksiTagihan)
    {
        //
    }
}
