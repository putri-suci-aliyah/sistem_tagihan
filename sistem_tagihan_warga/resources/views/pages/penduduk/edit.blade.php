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
    <div class="my-3 p-3 bg-body rounded shadow-sm">

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
        <div class="mb-3 row">
            <label for="spasi" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                <a href="{{ url('penduduk') }}" class="btn btn-secondary">KEMBALI</a>
            </div>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
@endsection
