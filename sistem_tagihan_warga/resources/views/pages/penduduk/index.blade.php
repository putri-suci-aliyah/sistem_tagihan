@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Data Master Warga</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Warga</li>
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
    <div class="pb-3">
        <a href='{{ url('penduduk/create') }}' class="btn btn-primary">+ Tambah Data Warga</a>
        <div class="d-inline-block ms-3">
            <!-- Content inside the new div -->
            <form class="d-flex" action="{{ url('penduduk') }}" method="get">
                <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-2">No. Kartu Keluarga</th>
                <th class="col-md-2">Nama</th>
                <th class="col-md-2">Nomor HP</th>
                <th class="col-md-3">Alamat Rumah</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = $data->firstItem(); ?>
            @foreach ($data as $item)
            <tr>
                <td>{{$no}}</td>
                <td>{{$item->no_kk}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->no_hp}}</td>
                <td>{{$item->alamat}}</td>
                <td>
                    <!-- HREF KE HALAMAN EDIT DATA -->
                    <a href='{{ url('penduduk/'.$item->no_kk.'/edit')}}' class="btn btn-warning btn-sm">Ubah</a>

                    <!-- FORM HAPUS DATA -->
                    <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="d-inline" action="{{ url('penduduk/'.$item->no_kk) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>

                </td>
            </tr>
            <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
</div>
@endsection
