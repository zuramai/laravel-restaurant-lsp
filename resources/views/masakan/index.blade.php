@extends('layouts.app')

@section("head_title", "Daftar Masakan")
@section("title")
<div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box" id="breadcrumb">
                    <h4 class="page-title">Masakan</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Menampilkan seluruh data masakan
                        </li>
                    </ol>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="container-fluid" id="result">           
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Daftar Masakan</h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah data seluruh masakan</p>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="card-actions ">
                        <a class='btn btn-primary float-left' href="{{ route('masakan.create') }}"><i class='ti ti-plus'></i> Tambah masakan</a>
                        <form action="" method="get" class='form-inline float-right mb-3'>
                            <input type="text" class="form-control" placeholder='Cari nama..' name='search'>
                            <button type="submit" class='btn btn-primary ml-2'>Cari</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($masakans as $masakan)
                            <tr>
                                <td>{{ $masakan->id }}</td>
                                <td><img src="{{ Storage::url('masakan/'.$masakan->image_name) }}" style='width:100px'></td>
                                <td>{{ $masakan->name }}</td>
                                <td>Rp {{ number_format($masakan->harga) }}</td>
                                <td><span class="badge badge-{{ $masakan->status ? 'success':'danger'   }}">{{ $masakan->status ? 'Tersedia' : 'Tidak Tersedia' }}</span></td>
                                <td>  
                                    <div class="d-inline-flex">
                                        <a href="{{ route('masakan.edit', ['masakan' => $masakan->id]) }}" class='btn btn-warning mr-2'>Edit</a>
                                        <form action="{{ route('masakan.destroy', ['masakan' => $masakan->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class='btn btn-danger'>Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @forelse($masakans as $masakan)
                            @empty
                            <tr class='text-center'>
                                <td colspan="6">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div> <!-- end container-fluid -->
@endsection
