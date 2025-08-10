<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\WargaPenduduk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;

class TransaksiController extends Controller
{
    //Method untuk memperbarui status pembayaran menjadi lunas
    public function pelunasan_tagihan(Request $request, $id){
        $data = Transaksi::where('id', $id)->first(); //Ambil data transaksi berdasarkan ID
        $data->status_pembayaran = "Lunas"; // Ubah status pembayaran jadi Lunas
        $data->save(); // Simpan perubahan ke database
        return redirect()->to('transaksi')->with('success', 'Data status pembayaran transaksi tagihan warga berhasil diubah');
    }

    // Method untuk mengirim notifikasi WhatsApp menggunakan Twilio
    public function notifikasi_whatsapp(Request $request, $id)
    {
        // Ambil transaksi dan relasi ke warga
        $data = Transaksi::where('id', $id)->with('warga_penduduks')->first();
        $total_pembayaran = 0; // Inisialisasi total pembayaran

        // Hitung total pembayaran berdasarkan qty * harga_tagihan
        foreach ($data->tagihan as $item) {
             $total_pembayaran += $item->pivot->qty * $item->pivot->harga_tagihan;
        };

        // Susun pesan yang akan dikirimkan
        $pesan = "Tagihan an. ". $data->warga_penduduks->nama . " dengan kode transaksi " . $data->kode_transaksi . " sebesar Rp. ". number_format($total_pembayaran);
        $pesan .= "\nDetail Tagihan : \n";

        // Tambahkan detail tagihan satu per satu
        $nomer = 1;
        foreach ($data->tagihan as $item) {
            $pesan .= $nomer++ . ". " .$item->kode_tagihan . " - Rp. ". number_format($item->pivot->qty * $item->pivot->harga_tagihan) . " \n";
        };

        $pesan .= "\nTerimakasih"; // Tambahkan ucapan penutup
        $notifikasi_wa = "Notifikasi WA ". $data->warga_penduduks->nama;

        // Mengambil nomor dari model WargaPenduduk (atribut: no_hp)
        $nomor = $data->warga_penduduks->no_hp;
        //mengecek apakahh nomor hp warga diawali dengan angka 0
        if (substr($nomor, 0, 1) === "0") {
            //jika iya, ubah format nya ke format internasional dgn +62
            $nomor_internasional = "+62" . substr($nomor, 1);
        } else {
            $nomor_internasional = $nomor;
        }


        try {
            // Kirim pesan via API Twilio
            $sid    = "xxx"; // SID Twilio
            $token  = "xxx"; // Token Twilio
            $twilio = new Client($sid, $token);  // Inisialisasi client Twilio

            $message = $twilio->messages
            ->create("whatsapp:".$nomor_internasional, // to
                array(
                "from" => "whatsapp:+1xxx",
                "body" => $pesan,
                )
            );
            // Jika berhasil, redirect ke halaman rooting transaksi dan tampilkan notifikasi berhasil
            return redirect()->to('transaksi')->with('success', $notifikasi_wa. ' telah terkirim.');
        } catch (\Throwable $th) {
            return redirect()->to('transaksi')->with('failed_whatsapp', $notifikasi_wa . ' gagal terkirim.');
        }
    }

    // Constructor untuk memastikan semua method hanya dapat diakses oleh user yang telah login
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar data transaksi
    public function index(Request $request)
    {
        // Jika ada kata kunci pencarian, lakukan filter
        $katakunci = $request->katakunci;
        if (strlen($katakunci)) {
            $data = Transaksi::where('kode_transaksi','like',"%$katakunci%")
                    ->orWhere('periode_bulan','like',"%$katakunci%")
                    ->orWhere('periode_tahun','like',"%$katakunci%")
                    ->orWhere('status_pembayaran','like',"%$katakunci%")
            ->orderBy('id','desc')->paginate(10);
        } else {
            $data = Transaksi::orderBy('id','desc')->paginate(10);
        }
        // return view akan memanggil dari folder pages>transaksi dari file index.blade.php
        // with('data', $data) digunakan untuk mengirimkan data dari controller ke view dengan nama variabel 'data'
        return view('pages.transaksi_tagihan.index')->with('data', $data);
    }

    // Menampilkan form untuk membuat data transaksi baru
    public function create()
    {
        $warga_penduduk = WargaPenduduk::all(); // Ambil semua data warga
        $tagihan = Tagihan::all(); // Ambil semua jenis tagihan
        // kedua variabel ini dikirimkan ke view agar bisa digunakan di dalam file create.blade.php
        return view('pages.transaksi_tagihan.create',compact('warga_penduduk','tagihan'));

    }

    // Menyimpan data transaksi baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            //exists: data yang diisi harus ada di tabel warga_penduduks kolom id
            'warga_penduduks_id' => 'required|exists:warga_penduduks,id',
            'periode_bulan' => 'required',
            //tahun tagihan harus diisi dan harus berupa angka (misal: 2025).
            'periode_tahun' => 'required|integer',
            // Validasi ini memastikan bahwa warga tidak bisa dimasukkan tagihan dua kali untuk bulan dan tahun yang sama.
            'periode_bulan' => [
                'required',
                Rule::unique('transaksis')
                    ->where(function ($query) use ($request) {
                        //tidak ada duplikat data tagihan untuk warga yang sama, bulan yang sama, dan tahun yang sama.
                        return $query->where('warga_penduduks_id', $request->warga_penduduks_id)
                                    ->where('periode_tahun', $request->periode_tahun)
                                    ->where('periode_bulan', $request->periode_bulan);
                    }),
            ],
        ], [
            'periode_bulan.unique' => 'Tagihan untuk warga ini pada periode tersebut sudah ada.',
        ]);
        // Buat objek baru dari model Transaksi dan simpan ke dalam variabel $transaksi.
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = "TAG/".time();
        $transaksi->warga_penduduks_id = $request->warga_penduduks_id;
        $transaksi->periode_bulan = $request->periode_bulan;
        $transaksi->periode_tahun = $request->periode_tahun;
        $transaksi->save();

        $harga_tagihan = $request->input('harga_tagihan'); // [id => harga]
        $qty = $request->input('qty'); // [id => qty]

        $syncData = [];

        foreach ($qty as $tagihan_id => $jumlah) {
            if ($jumlah > 0) {
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
        $warga_penduduk = WargaPenduduk::all();
        return view('pages.transaksi_tagihan.edit',compact('data','warga_penduduk'));
    }


    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'warga_penduduks_id' => 'required|exists:warga_penduduks,id',
            'periode_bulan' => 'required',
            'periode_tahun' => 'required|integer',
            'periode_bulan' => [
            'required',
            Rule::unique('transaksis')
                ->where(function ($query) use ($request) {
                    return $query->where('warga_penduduks_id', $request->warga_penduduks_id)
                                ->where('periode_tahun', $request->periode_tahun)
                                ->where('periode_bulan', $request->periode_bulan);
                }),
            ],
        ], [
            'periode_bulan.unique' => 'Tagihan untuk warga ini pada periode tersebut sudah ada.',
        ]);
        $harga_tagihan = $request->input('harga_tagihan'); // [id => harga]
        $qty = $request->input('qty'); // [id => qty]

        //array kosong untuk menyimpan data tagihan yang akan disinkronkan ke tabel pivot tagihan_transaksi.
        $syncData = [];

        foreach ($qty as $tagihan_id => $jumlah) {
            if ($jumlah > 0) {  // only sync if qty > 0, optional check
                $syncData[$tagihan_id] = [
                    'qty' => $jumlah,
                    'harga_tagihan' => $harga_tagihan[$tagihan_id] ?? 0,
                ];
            }
        }

        $transaksi->warga_penduduks_id = $request->warga_penduduks_id;
        $transaksi->periode_bulan = $request->periode_bulan;
        $transaksi->periode_tahun = $request->periode_tahun;
        $transaksi->save();
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
