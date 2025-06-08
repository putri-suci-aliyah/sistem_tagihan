@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Data Master Tagihan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tagihan</li>
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
<form action='{{ url('tagihan/'.$data->id) }}' method='post'>
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">Kode Tagihan</label>
            <div class="col-sm-10">
                {{$data->kode_tagihan}}
            </div>
        </div>
         <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Jenis Tagihan</label>
            <div class="col-sm-10">
                @if($data->jenis_tagihan == 1)
                    Tagihan Air
                @elseif($data->jenis_tagihan == 2)
                    Tagihan Keamanan
                @else
                    Tagihan Sampah
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Harga Tagihan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $data->harga_tagihan}}" name='harga_tagihan' id="harga_tagihan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="spasi" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                <a href="{{ url('tagihan') }}" class="btn btn-secondary">KEMBALI</a>
            </div>
        </div>
    </div>
</form>
@endsection
