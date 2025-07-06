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

@if (Session::has('success'))
    <div class="pt.3">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
    @endif

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="pb-3 d-flex justify-content-between align-items-center">
            <a href='{{ url('user/create') }}' class="btn btn-primary">
                <i class="bi bi-file-earmark-plus"></i> Tambah Data User
            </a>
            {{-- <form class="d-flex" action="{{ url('user') }}" method="get" style="width: 300px;">
                <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit"><i class="bi bi-search"></i></button>
            </form> --}}
            <div class="card-tools">
                <form class="d-flex" action="{{ url('user') }}" method="get">
                <div class="input-group input-group" style="width: 250px;">

                    <input type="search" name="katakunci" class="form-control float-right" value="{{ Request::get('katakunci') }}" placeholder="Masukan Kata Kunci">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>

                </div>
                </form>
            </div>
        </div>
    {{-- <div class="pb-3">
        <a href='{{ url('user/create') }}' class="btn btn-primary">+ Tambah Data User</a>
        <div class="d-inline-block ms-3">
            <!-- Content inside the new div -->
            <form class="d-flex" action="{{ url('user') }}" method="get">
                <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>
    </div> --}}

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-2">Nama User</th>
                <th class="col-md-2">Email User</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = $data->firstItem(); ?>
            @foreach ($data as $item)
            <tr>
                <td>{{$no}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>
                    <!-- HREF KE HALAMAN EDIT DATA -->
                    <a href='{{ url('user/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>Ubah</a>

                    <!-- FORM HAPUS DATA -->
                    {{-- <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="d-inline" action="{{ url('user/'.$item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form> --}}

                </td>
            </tr>
            <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
</div>
@endsection
