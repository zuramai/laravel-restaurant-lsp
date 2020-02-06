@extends('layouts.app')

@section("head_title", "Daftar Order")
@section("title")
<div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box" id="breadcrumb">
                    <h4 class="page-title">Order</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Menampilkan seluruh data order
                        </li>
                    </ol>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="container-fluid" id="result">           
    <pesan-makanan masakans="{{ $masakans }}" mejas="{{$mejas}}" userid="{{Auth::user()->id}}"></pesan-makanan>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Daftar Order</h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah data seluruh order</p>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                 
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Masakan</th>
                                <th>Meja</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                            
                            @foreach($orders as $order)
                            @php
                                $harga=0; 
                            @endphp
                            @foreach($order->detail as $detail) 
                                @php 
                                    $harga += $detail->masakan->harga 
                                @endphp  
                            @endforeach
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>@foreach($order->detail as $detail) {{$detail->masakan->name}}, @endforeach</td>
                                <td>Meja {{ $order->meja->no_meja }} - {{$order->meja->name}}</td>
                                <td>Rp {{number_format($harga)}}</td>
                                <td><span class="badge badge-{{ $order->status_order == 'Processing' ? 'primary':'danger'   }}">{{ $order->status_order }}</span></td>
                               
                            </tr>
                            @endforeach
                            @forelse($orders as $order)
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
