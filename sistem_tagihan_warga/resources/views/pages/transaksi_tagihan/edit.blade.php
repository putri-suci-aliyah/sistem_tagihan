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
            <h3 class="card-title">Form Edit Transaksi Tagihan</h3>
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
                    <select id="warga_penduduks_id" name="warga_penduduks_id" class="form-control select2" style="width: 100%;">
                        @foreach ($warga_penduduk as $data_warga)
                            <option value="{{ $data_warga->id }}" {{ $data_warga->id == $data->warga_penduduks->id ? 'selected' : '' }}>
                                {{ $data_warga->no_kk }} - {{ $data_warga->nama }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>
            @php
                $daftar_bulan = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
            @endphp
            <div class="form-group row">
                <label for="reservationdate" class="col-sm-2 col-form-label">Bulan </label>
                <div class="col-sm-10">
                    <div class="input-group" id="reservationdate">
                        <select id="periode_bulan" name="periode_bulan" class="form-control select2" style="width: 50%;">
                            @foreach ($daftar_bulan as $bulan)
                                <option value="{{ $bulan }}" {{ $data->periode_bulan == $bulan ? 'selected' : '' }}>
                                    {{ $bulan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="reservationdate" class="col-sm-2 col-form-label">Tahun </label>
                <div class="col-sm-10">
                    <div class="input-group" id="reservationdate">
                        <select id="periode_tahun" name="periode_tahun" class="form-control select2" style="width: 10%;">
                            <option value="{{ $data->periode_tahun }}" selected>
                                {{ $data->periode_tahun }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Data Tagihan</label>
            <div class="col-sm-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-2">Kode Tagihan</th>
                            <th class="col-md-2">Harga</th>
                            <th class="col-md-1">Qty</th>
                            <th class="col-md-2">Sub Total</th>
                        </tr>
                        @php
                            $no = 1;
                            $total = 0;
                        @endphp
                        @foreach ($data->tagihan as $data_tagihan)
                            @if($data_tagihan->kode_tagihan == 'TAG-AIR')
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$data_tagihan->kode_tagihan}}</td>
                                    <td><input type="number" class="form-control harga_tagihan" name="harga_tagihan[{{$data_tagihan->id}}]" id="harga_tagihan[{{$data_tagihan->id}}]" value="{{$data_tagihan->harga_tagihan}}" readonly></td>
                                    <td><input type="number" class="form-control qty" name='qty[{{$data_tagihan->id}}]' id="qty{{$data_tagihan->id}}" value="{{$data_tagihan->pivot->qty}}"></td>
                                    <td><input type="number" class="form-control total_bayar" name='total_bayar[{{$data_tagihan->id}}]' id="total_bayar[{{$data_tagihan->id}}]" value="{{$data_tagihan->pivot->qty * $data_tagihan->pivot->harga_tagihan}}" readonly></td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$data_tagihan->kode_tagihan}}</td>
                                    <td><input type="number" class="form-control harga_tagihan" name="harga_tagihan[{{$data_tagihan->id}}]" id="harga_tagihan[{{$data_tagihan->id}}]" value="{{$data_tagihan->harga_tagihan}}" readonly></td>
                                    <td><input type="number" class="form-control qty" name='qty[{{$data_tagihan->id}}]' id="qty{{$data_tagihan->id}}" value="{{$data_tagihan->pivot->qty}}" readonly></td>
                                    <td><input type="number" class="form-control total_bayar" name='total_bayar[{{$data_tagihan->id}}]' id="total_bayar[{{$data_tagihan->id}}]" value="{{$data_tagihan->pivot->qty * $data_tagihan->pivot->harga_tagihan}}" readonly></td>
                                </tr>
                            @endif
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
    <div class="card-footer d-flex justify-content-end">
        <a href="{{ url('transaksi') }}" class="btn btn-secondary mr-2">Batal</a>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </div>
    </div>

</form>
@endsection
