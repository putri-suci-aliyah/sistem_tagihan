<?php

namespace App\Http\Controllers;

use App\Models\penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class pendudukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        if (strlen($katakunci)) {
            $data = penduduk::where('nama','like',"%$katakunci%")
                    ->orWhere('alamat','like',"%$katakunci%")
                    ->orWhere('no_kk','like',"%$katakunci%")
                    ->orWhere('no_hp','like',"%$katakunci%")
            ->orderBy('no_kk','desc')->paginate(10);
        } else {
            $data = penduduk::orderBy('no_kk','desc')->paginate(10);
        }

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
        Session::flash('no_kk',$request->no_kk);
        Session::flash('nama',$request->nama);
        Session::flash('alamat',$request->alamat);
        Session::flash('no_hp',$request->no_hp);



        # ============= UNTUK VALIDASI DATA INPUTAN
        $request->validate([
            'no_kk' => ['required', 'numeric', 'digits:16', 'unique:penduduks,no_kk'],
            'nama'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required',
        ],[
            //required: hrs di isi
            'no_kk.digits' => 'No KK harus terdiri dari 16 digit angka',
            'no_kk.required' => 'No KK wajib diisi',
            'no_kk.numeric' => 'No KK harus angka',
            'no_kk.unique' => 'No KK sudah ada di database',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
        ]);

        $data = [
            'no_kk'=>$request->no_kk,
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_hp'=>$request->no_hp,
        ];

        penduduk::create($data);

        return redirect()->to('penduduk')->with('success', 'Data penduduk berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = penduduk::where('no_kk', $id)->first();
        return view('pages.penduduk.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        $data = [
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_hp'=>$request->no_hp
        ];

        penduduk::where('no_kk', $id)->update($data);
        return redirect()->to('penduduk')->with('success', 'Data penduduk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        penduduk::where('no_kk', $id)->delete();
        return redirect()->to('penduduk')->with('success', 'Data penduduk berhasil dihapus');
    }
}
