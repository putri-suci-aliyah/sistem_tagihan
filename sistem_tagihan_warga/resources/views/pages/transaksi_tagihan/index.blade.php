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
        <div class="pb-3">
            <a href='{{ url('transaksi_tagihan/create') }}' class="btn btn-primary">+ Tambah Data Transaksi</a>
            <div class="d-inline-block ms-3">
                <!-- Content inside the new div -->
                 <form class="d-flex" action="{{ url('transaksi_tagihan') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </form>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">Kode Transaksi</th>
                    <th class="col-md-2">Tanggal Transaksi</th>
                    <th class="col-md-3">Nama Warga</th>
                    <th class="col-md-2">Status Pembayaran</th>
                    <th class="col-md-2">Total Tagihan</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
        </table>
        {{-- {{ $data->withQueryString()->links() }} --}}
    </div>
@endsection
