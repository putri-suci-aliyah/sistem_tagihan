@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Tambah Data Master Penduduk</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Penduduk</li>
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

<form action='{{ url('penduduk') }}' method='post'>
    @csrf
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Data Penduduk</h3>
        </div>
        <div class="card-body">
            <div class="mb-3 row">
                <label for="nim" class="col-sm-2 col-form-label">No. KK <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name='no_kk' value="{{ Session::get('no_kk')}}" id="no_kk">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ Session::get('nama')}}" name='nama' id="nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Alamat <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name='alamat' id="alamat">{{ Session::get('alamat')}}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="no_hp" class="col-sm-2 col-form-label">Nomor HP <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" value="{{ Session::get('no_hp')}}" name='no_hp' id="no_hp">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-default float-right">Batal</button>
        </div>
    </div>
</form>
@endsection
