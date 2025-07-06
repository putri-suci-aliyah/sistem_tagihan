@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Transaksi Tagihan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Transaksi Tagihan</li>
        </ol>
        </div>
    </div>
@endsection

@section('content')
@if (Session::has('success'))
    <div class="pt.3">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
    @endif
    <div class="my-3 p-3 bg-body rounded shadow-sm">

        <div class="pb-3 d-flex justify-content-between align-items-center">
        <a href='{{ url('transaksi/create') }}' class="btn btn-primary">
            <i class="bi bi-file-earmark-plus"></i> Tambah Data Transaksi
        </a>
        {{-- <form class="d-flex" action="{{ url('warga_penduduk') }}" method="get" style="width: 300px;">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit"><i class="bi bi-search"></i></button>
        </form> --}}
        <div class="card-tools">
            <form class="d-flex" action="{{ url('transaksi') }}" method="get">
            <div class="input-group input-group" style="width: 250px;">

                <input type="search" name="katakunci" class="form-control float-right" value="{{ Request::get('katakunci') }}" placeholder="Masukan Kata Kunci">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>

            </div>
            </form>
        </div>
    </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-1">Kode Transaksi</th>
                    <th class="col-md-2">Nama Warga</th>
                    <th class="col-md-2">Total Tagihan</th>
                    <th class="col-md-2">Status</th>
                    <th class="col-md-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = $data->firstItem(); ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$item->kode_transaksi}}</td>
                        <td>{{$item->warga_penduduks->no_kk}} - {{$item->warga_penduduks->nama}}</td>

                        <td>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($item->tagihan as $detail_transaksi)
                                @php
                                    $total += $detail_transaksi->pivot->qty * $detail_transaksi->pivot->harga_tagihan;
                                @endphp
                            @endforeach
                            Rp. {{ number_format($total, 2) }}
                        </td>
                        <td>
                            @if($item->status_pembayaran == "1")
                                Belum Lunas
                            @else
                                Lunas
                            @endif
                        </td>
                        <td>
                            @if($item->status_pembayaran !== '2')
                                <!-- HREF KE HALAMAN EDIT DATA -->
                                <a href='{{ url('transaksi/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>Ubah</a>


                                <!-- FORM HAPUS DATA -->
                                <div class="modal fade" id="confirmDeleteModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{$item->id}}">Konfirmasi Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data ini?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ url('transaksi/'.$item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-info btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal{{$item->id}}">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>


                                <!-- KIRIM NOTIFIKASI WAHATSAPP -->
                                <div class="modal fade" id="confirmWAModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{$item->id}}">Konfirmasi WA</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin akan kirim notifikasi ?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ url('transaksi/notifikasi_whatsapp/'.$item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-info btn-sm">Kirim</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#confirmWAModal{{$item->id}}">
                                    <i class="fab fa-whatsapp"></i> WA
                                </button>

                                <div class="modal fade" id="confirmLunasModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{$item->id}}">Konfirmasi Pelunasan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin akan untuk pelunasan ?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ url('transaksi/pelunasan_tagihan/'.$item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-info btn-sm">Lunas</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#confirmLunasModal{{$item->id}}">
                                    <i class="bi bi-check2-square"></i> Pelunasan
                                </button>


                            @endif
                        </td>
                    </tr>
                    <?php $no++; ?>
                @endforeach
            </tbody>
        </table>
        {{ $data->withQueryString()->links() }}
    </div>
@endsection
