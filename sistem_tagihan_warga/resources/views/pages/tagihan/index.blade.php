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
    {{-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}
    @if (Session::has('success'))
    <div class="pt.3">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
    @endif


    <div class="my-3 p-3 bg-body rounded shadow-sm">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No.</th>
                    <th class="col-md-3">Kode Tagihan</th>
                    <th class="col-md-3">Jenis Tagihan</th>
                    <th class="col-md-3">Harga Tagihan</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = $data->firstItem(); ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$item->kode_tagihan}}</td>
                        <td>
                            @if($item->jenis_tagihan == 1)
                                Tagihan Air
                            @elseif($item->jenis_tagihan == 2)
                                Tagihan Keamanan
                            @else
                                Tagihan Sampah
                            @endif
                        </td>
                        <td>{{$item->harga_tagihan}}</td>
                        <td>
                            <!-- HREF KE HALAMAN EDIT DATA -->
                            <a href='{{ url('tagihan/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm">Ubah</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                @endforeach
            </tbody>
        </table>
        {{ $data->withQueryString()->links() }}
    </div>
@endsection
