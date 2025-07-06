@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Data Transaksi Tagihan</h1>
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

@if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif


<form action='{{ url('transaksi/'.$data->id) }}' method='post'>
    @csrf
    @method('PUT')
    <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Form Transaksi Tagihan</h3>
            </div>

        <div class="card-body">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Transaksi</label>
                <div class="col-sm-10">
                    <div class="col-sm-10">
                        {{$data->kode_transaksi}}
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <label for="reservationdate" class="col-sm-2 col-form-label">Data Warga</label>
                <div class="col-sm-10">
                    {{$data->warga_penduduks->nama}} - {{$data->warga_penduduks->no_kk}}
                </div>
            </div>

            <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Data Tagihan</label>
            <div class="col-sm-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Kode Tagihan</th>
                            <th class="col-md-1">Harga</th>
                            <th class="col-md-1">Qty</th>
                            <th class="col-md-2">Sub Total</th>
                        </tr>
                        @php
                            $no = 1;
                            $total = 0;
                        @endphp
                        @foreach ($data->tagihan as $data_tagihan)
                            <tr>
                                <td>{{$no++}}.</td>
                                <td>{{$data_tagihan->kode_tagihan}}</td>
                                <td><input type="number" class="form-control harga_tagihan" name="harga_tagihan[{{$data_tagihan->id}}]" id="harga_tagihan[{{$data_tagihan->id}}]" value="{{$data_tagihan->harga_tagihan}}" readonly></td>
                                <td><input type="number" class="form-control qty" name='qty[{{$data_tagihan->id}}]' id="qty{{$data_tagihan->id}}" value="{{$data_tagihan->pivot->qty}}"></td>
                                <td><input type="number" class="form-control total_bayar" name='total_bayar[{{$data_tagihan->id}}]' id="total_bayar[{{$data_tagihan->id}}]" value="{{$data_tagihan->pivot->qty * $data_tagihan->pivot->harga_tagihan}}" readonly></td>
                            </tr>

                            @php
                                    $total += $data_tagihan->pivot->qty * $data_tagihan->pivot->harga_tagihan;
                            @endphp
                        @endforeach
                        <tr>
                            <th class="col-md-1"></th>
                            <th class="col-md-3"></th>
                            <th class="col-md-1"></th>
                            <th class="col-md-1">Total Pembayaran</th>
                            <th class="col-md-2"><input type="number" class="form-control total_bayar" name='total_pembayaran' id="total_pembayaran" value="{{$total}}" readonly></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-default float-right">Batal</button>
    </div>
    </div>

</form>
@endsection
