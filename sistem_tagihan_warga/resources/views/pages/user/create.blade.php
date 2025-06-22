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
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Form Data User</h3>
        </div>
        <div class="card-body">
            <div class="mb-3 row">
                <label for="nim" class="col-sm-2 col-form-label">Nama User <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='name' value="{{ Session::get('name')}}" id="name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Email <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" value="{{ Session::get('email')}}" name='email' id="email">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Password <span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" value="{{ Session::get('password')}}" name='password' id="password">
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
