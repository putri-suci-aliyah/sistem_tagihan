<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tagihan::orderBy('id','desc')->paginate(3);
        return view('pages.tagihan.index')->with('data', $data);
    }


    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        return view('pages.tagihan.edit')->with('data', $tagihan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        $request->validate([
            'harga_tagihan'=>'required'
        ],[
            'harga_tagihan.required' => 'Harga Tagihan wajib diisi',
        ]);

        $data = [
            'harga_tagihan'=>$request->harga_tagihan
        ];

        $tagihan->update($data);
        return redirect()->to('tagihan')->with('success', 'Data tagihan berhasil diubah');
    }
}
