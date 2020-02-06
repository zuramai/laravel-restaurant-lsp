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
                            Menampilkan seluruh data Masakan
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

                    <h4 class="mt-0 mb-4 header-title">Tambah Masakan</h4>
                    <form action="{{ route('masakan.update', ['masakan' => $masakan->id]) }}" method="post" enctype='multipart/form-data'>
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Masakan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nasi Goreng" name='name' id="example-text-input" value="{{ $masakan->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" placeholder="30000" name='harga' id="example-text-input" value="{{ $masakan->harga }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="" class="form-control">
                                    <option value="1" {{$masakan->status ? 'selected' : ''}}>Tersedia</option>
                                    <option value="0" {{!$masakan->status ? 'selected' : ''}}>Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" class='form-control-file' name='image'>
                                <img src="{{ Storage::url('/masakan/'.$masakan->image_name) }}" alt="" style='width:100px' class='mt-3'>
                            </div>
                        </div>
                        <button type="submit" class='btn btn-primary float-right'>Submit</button>
                    </form>                    
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div> <!-- end container-fluid -->
@endsection
