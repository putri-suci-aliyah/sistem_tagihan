<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\WargaPenduduk;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TransaksiController extends Controller
{
    public function pelunasan_tagihan(Request $request, $id){
        $data = Transaksi::where('id', $id)->first();
        $data->status_pembayaran = "2";
        $data->save();
        return redirect()->to('transaksi')->with('success', 'Data status pembayaran transaksi tagihan warga berhasil diubah');
    }
    public function notifikasi_whatsapp(Request $request, $id)
    {
        $data = Transaksi::where('id', $id)->with('warga_penduduks')->first();
        $total_pembayaran = 0;
        foreach ($data->tagihan as $item) {
             $total_pembayaran += $item->pivot->qty * $item->pivot->harga_tagihan;
        };

        $pesan = "Tagihan an. ". $data->warga_penduduks->nama . " dengan kode transaksi " . $data->kode_transaksi . " sebesar Rp. ". number_format($total_pembayaran);
        $notifikasi_wa = "Notifikasi WA ". $data->warga_penduduks->nama;

        $nomor = $data->warga_penduduks->no_hp;
        if (substr($nomor, 0, 1) === "0") {
            $nomor_internasional = "+62" . substr($nomor, 1);
        } else {
            $nomor_internasional = $nomor;
        }


        try {

            $sid    = "AC43f9d58a22c8dc128b735cee53c421ee";
            $token  = "16d13941a42fe6feccbcb9c79df17169";
            $twilio = new Client($sid, $token);
            # 6285295400354
            $message = $twilio->messages
            ->create("whatsapp:".$nomor_internasional, // to
                array(
                "from" => "whatsapp:+14155238886",
                "body" => $pesan,
                )
            );
            return redirect()->to('transaksi')->with('success', $notifikasi_wa. ' telah terkirim.');
        } catch (\Throwable $th) {
            return redirect()->to('transaksi')->with('failed_whatsapp', $notifikasi_wa . ' gagal terkirim.');
        }
    }
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
            $data = Transaksi::where('kode_transaksi', 'like', "%$katakunci%")
            ->with('warga_penduduks')
            ->orderBy('id', 'desc')
            ->paginate(2);
        } else {
           $data = Transaksi::with('warga_penduduks')
            ->orderBy('id', 'desc')
            ->paginate(2);
        }
        return view('pages.transaksi_tagihan.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warga_penduduk = WargaPenduduk::all();
        $tagihan = Tagihan::all();
        return view('pages.transaksi_tagihan.create',compact('warga_penduduk','tagihan'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = "TAG/".time();
        $transaksi->warga_penduduks_id = $request->warga_penduduks_id;
        $transaksi->save();

        $harga_tagihan = $request->input('harga_tagihan'); // [id => harga]
        $qty = $request->input('qty'); // [id => qty]

        $syncData = [];

        foreach ($qty as $tagihan_id => $jumlah) {
            if ($jumlah > 0) {  // only sync if qty > 0, optional check
                $syncData[$tagihan_id] = [
                    'qty' => $jumlah,
                    'harga_tagihan' => $harga_tagihan[$tagihan_id] ?? 0,
                ];
            }
        }

        $transaksi->tagihan()->sync($syncData);

        return redirect()->to('transaksi')->with('success', 'Data transasi tagihan warga berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $data = $transaksi;
        return view('pages.transaksi_tagihan.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $harga_tagihan = $request->input('harga_tagihan'); // [id => harga]
        $qty = $request->input('qty'); // [id => qty]

        $syncData = [];

        foreach ($qty as $tagihan_id => $jumlah) {
            if ($jumlah > 0) {  // only sync if qty > 0, optional check
                $syncData[$tagihan_id] = [
                    'qty' => $jumlah,
                    'harga_tagihan' => $harga_tagihan[$tagihan_id] ?? 0,
                ];
            }
        }

        $transaksi->tagihan()->sync($syncData);

        return redirect()->to('transaksi')->with('success', 'Data transasi tagihan warga berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->to('transaksi')->with('success', 'Data transaksi tagihan warga berhasil dihapus');
    }
}
