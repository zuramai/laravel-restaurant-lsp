@extends('layouts.app')

@section("head_title", "Laporan")
@section("title")
<div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box" id="breadcrumb">
                    <h4 class="page-title">Laporan</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Data Laporan 
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

                    <h4 class="mt-0 header-title">Data Statistik Restoran</h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah rekap seluruh data</p>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Total Pengguna</td>
                                <td>
                                    <ul>
                                        <li>
                                            {{$data['totalUser']}} Pengguna:
                                            <ul>
                                                <li>{{ $data['totalPelanggan'] }} Pelanggan</li>
                                                <li>{{ $data['totalWaiter'] }} Waiter</li>
                                                <li>{{ $data['totalKasir'] }} Kasir</li>
                                                <li>{{ $data['totalOwner'] }} Owner</li>
                                                <li>{{ $data['totalAdmin'] }} Admin</li>
                                            </ul>
                                        </li>

                                    </ul>
                                </td>
                                <td><a href='{{ route("pengguna.index") }}'><i class='ti ti-eye'></i> Lihat</a></td>
                            </tr>
                            <tr>
                                <td>Total Pesanan</td>
                                <td>
                                    <ul>
                                    <li>{{ $data['totalOrder'] }} Order: 
                                        <ul>
                                            <li>{{ $data['totalOrderSuccess'] }} Sukses</li>
                                            <li>{{ $data['totalOrderCanceled'] }} Canceled</li>
                                            <li>{{ $data['totalOrderProcessing'] }} Processing</li>    
                                        </ul>
                                    </li>
                                    </ul>
                                </td>
                                <td><a href='{{ route("order.index") }}'><i class='ti ti-eye'></i> Lihat</a></td>
                            </tr>
                            <tr>
                                <td>Total Meja</td>
                                <td>{{ $data['totalMeja'] }} Meja</td>
                                <td><a href='#'><i class='ti ti-eye'></i> Lihat</a></td>
                            </tr>
                            <tr>
                                <td>Total Masakan</td>
                                <td>{{ $data['totalMasakan'] }} Masakan</td>
                                <td><a href='{{ route("masakan.index") }}'><i class='ti ti-eye'></i> Lihat</a></td>
                            </tr>
                            <tr>
                                <td>Total Transaksi</td>
                                <td>{{ $data['totalTransaction'] }} Transaksi Sukses</td>
                                <td><a href='{{ route("transaksi.index") }}'><i class='ti ti-eye'></i> Lihat</a></td>
                            </tr>
                            <tr>
                                <td>Total Transaksi Hari Ini</td>
                                <td>{{ $data['totalTransactionToday'] }} Transaksi Hari Ini</td>
                                <td><a href='{{ route("transaksi.index") }}'><i class='ti ti-eye'></i> Lihat</a></td>
                            </tr>
                        </table>
                    </div>
                  
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    


</div> <!-- end container-fluid -->
@endsection
@push('styles')
    <style>
        ul {
            padding-left:15px !important;
            margin-bottom:0;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function getData() {
            
        }
    </script>
@endpush
