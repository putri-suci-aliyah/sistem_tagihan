@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Data Master User</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User</li>
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
<form action='{{ url('user') }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">Nama User</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='name' value="{{ Session::get('name')}}" id="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" value="{{ Session::get('email')}}" name='email' id="email">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" value="{{ Session::get('password')}}" name='password' id="password">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="spasi" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                <a href="{{ url('user') }}" class="btn btn-secondary">KEMBALI</a>
            </div>
        </div>
    </div>
</form>
@endsection
