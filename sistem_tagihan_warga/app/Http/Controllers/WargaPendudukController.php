<?php

namespace App\Http\Controllers;

use App\Models\WargaPenduduk;
use Illuminate\Http\Request;

class WargaPendudukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Fungsi index di gunakan untuk menampilkan halaman tampilan awal data penduduk
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        if (strlen($katakunci)) {
            $data = WargaPenduduk::where('nama','like',"%$katakunci%")
                    ->orWhere('alamat','like',"%$katakunci%")
                    ->orWhere('no_kk','like',"%$katakunci%")
                    ->orWhere('no_hp','like',"%$katakunci%")
            ->orderBy('no_kk','desc')->paginate(10);
        } else {
            $data = WargaPenduduk::orderBy('no_kk','desc')->paginate(10);
        }
        // return view akan memanggil dari folder pages>penduduk dari file index.blade.php
        // with : mengambil dari database
        return view('pages.penduduk.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.penduduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => ['required', 'numeric', 'digits:16', 'unique:warga_penduduks,no_kk'],
            'nama'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required',
        ],[
            'no_kk.digits' => 'No KK harus terdiri dari 16 digit angka',
            'no_kk.required' => 'No KK wajib diisi',
            'no_kk.numeric' => 'No KK harus angka',
            'no_kk.unique' => 'No KK sudah ada di database',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
        ]);


        $warga = new WargaPenduduk();
        //=====dari field tabel=========ini dari view
        $warga->no_kk = $request->no_kk;
        $warga->nama = $request->nama;
        $warga->alamat = $request->alamat;
        $warga->no_hp = $request->no_hp;
        $warga->save();
        //
        return redirect()->to('warga_penduduk')->with('success', 'Data warga berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(WargaPenduduk $wargaPenduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WargaPenduduk $wargaPenduduk)
    {
        $data = $wargaPenduduk;
        return view('pages.penduduk.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WargaPenduduk $wargaPenduduk)
    {
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required'
        ],[
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
        ]);

        $wargaPenduduk->nama = $request->nama;
        $wargaPenduduk->alamat = $request->alamat;
        $wargaPenduduk->no_hp = $request->no_hp;
        $wargaPenduduk->save(); //UPDATE faculties SET ....

        return redirect()->to('warga_penduduk')->with('success', 'Data penduduk berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WargaPenduduk $wargaPenduduk)
    {
        $wargaPenduduk->delete();
        return redirect()->to('warga_penduduk')->with('success', 'Data warga berhasil dihapus');
    }
}
