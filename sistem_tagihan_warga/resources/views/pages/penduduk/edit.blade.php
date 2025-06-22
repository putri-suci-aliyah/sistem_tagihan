@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit Data Master Penduduk</h1>
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
<!-- START FORM -->
<form action='{{ url('penduduk/'.$data->no_kk) }}' method='post'>
    @csrf
    @method('PUT')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Edit Data Penduduk</h3>
        </div>
        <div class="card-body">
            <div class="mb-3 row">
                <label for="nim" class="col-sm-2 col-form-label">No. KK</label>
                <div class="col-sm-10">
                    {{$data->no_kk}}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->nama}}" name='nama' id="nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Alamat <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name='alamat' id="alamat">{{ $data->alamat }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nomor Hp <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" value="{{ $data->no_hp}}" name='no_hp' id="no_hp">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-default float-right">Batal</button>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
@endsection
