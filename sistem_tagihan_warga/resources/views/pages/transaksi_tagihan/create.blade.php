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


<form action='{{ url('transaksi_tagihan') }}' method='post' class="form-horizontal">
    @csrf

        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Transaksi Tagihan</h3>
              </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kode_transaksi" value="AUTO GENERATE" readonly>
                    </div>
                </div>


                 <div class="form-group row">
                    <label for="reservationdate" class="col-sm-2 col-form-label">Data Warga</label>
                    <div class="col-sm-10">
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <select class="form-control select2" style="width: 100%;">
                                @foreach ($penduduk as $data_penduduk)
                                    <option value="{{ $data_penduduk->no_kk }}">
                                        {{ $data_penduduk->no_kk }} - {{ $data_penduduk->nama }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reservationdate" class="col-sm-2 col-form-label">Status Pembayaran</label>
                    <div class="col-sm-10">
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <select class="form-control select2" style="width: 100%;">
                                <option value="1">Belum Lunas</option>
                                <option value="2">Lunas</option>
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
                            @php $no = 1; @endphp
                            @foreach ($tagihan as $data_tagihan)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$data_tagihan->kode_tagihan}}</td>
                                    <td><input type="number" class="form-control harga_tagihan" name="harga_tagihan[{{$data_tagihan->id}}]" id="harga_tagihan[{{$data_tagihan->id}}]" value="{{$data_tagihan->harga_tagihan}}" readonly></td>
                                    <td><input type="number" class="form-control qty" name='qty[{{$data_tagihan->id}}]' id="qty{{$data_tagihan->id}}"></td>
                                    <td><input type="number" class="form-control total_bayar" name='total_bayar[{{$data_tagihan->id}}]' id="total_bayar[{{$data_tagihan->id}}]" readonly></td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="col-md-1"></th>
                                <th class="col-md-3"></th>
                                <th class="col-md-1"></th>
                                <th class="col-md-1">Total Pembayaran</th>
                                <th class="col-md-2"><input type="number" class="form-control total_bayar" name='total_pembayaran' id="total_pembayaran" readonly></th>
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
