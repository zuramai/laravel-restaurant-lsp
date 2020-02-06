@extends('layouts.app')

@section("head_title", "Daftar Order")
@section("title")
<div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box" id="breadcrumb">
                    <h4 class="page-title">Transaksi</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Menampilkan seluruh data transaksi
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

                    <h4 class="mt-0 header-title">Daftar Pesanan Baru</h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah data seluruh transaksi</p>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <form action="{{ route('transaksi.finish', ['id' => $order->id]) }}" method="post">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>ID Order</td>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pemesan</td>
                                        <td>{{ $order->pelanggan->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Meja</td>
                                        <td>{{$order->meja->no_meja}} - {{ $order->meja->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Masakan Dipesan</td>
                                        <td>
                                            <ul>
                                            @foreach($order->detail as $detail) 
                                                <li>{{$detail->quantity}} {{$detail->masakan->name}}  (Rp {{number_format($detail->price)}})</li>
                                            @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pesanan</td>
                                        <td>{{ Carbon\Carbon::parse($order->created_at)->format('d F Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Pesanan</td>
                                        <td>
                                            <span class="badge badge-{{ $order->status_order == 'Processing' ? 'primary' : 'success' }}">{{ $order->status_order }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td>Rp {{number_format($order->total_price)}}</td>
                                    </tr>
                                        @csrf
                                        <tr>
                                            <td>Jumlah Bayar</td>
                                            @if($order->status_order != 'Success')
                                            <td><input type="text" name="jumlah_bayar" id="" class="form-control" placeholder='Rp ' required min="{{ $order->total_price }}"></td>
                                            @else
                                            <td>Rp {{ number_format($order->transaction->total_bayar) }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Kembalian</td>
                                            @if($order->status_order != 'Success')
                                                <td>Rp <input type="text" class='borderless' value='0' id='kembalian'></td>
                                            @else
                                                <td>Rp <input type="text" class='borderless' value='{{ $order->transaction->total_bayar - $order->transaction->total_harga }}'></td>
                                            @endif
                                        </tr>
                                        @if($order->status_order != 'Success')
                                        <tr>
                                            <td></td>
                                            
                                            <td>
                                                <button class="btn btn-success" type='submit'><i class="ti ti-check"></i> Selesaikan Pesanan</button>
                                            </td>
                                        </tr>
                                        @endif
                                    
                                </tbody>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div> <!-- end container-fluid -->
@endsection
@push('scripts')
    <script>
        function getData() {
            
        }
    </script>
@endpush
