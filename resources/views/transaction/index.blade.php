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
                  
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Masakan</th>
                                <th>Meja</th>
                                <th>Pelanggan</th>
                                <th>Total Harga</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            
                            @foreach($orders as $order)
                            
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>@foreach($order->detail as $detail) {{$detail->masakan->name}}, @endforeach</td>
                                <td>Meja {{ $order->meja->no_meja }}</td>
                                <td>{{ $order->pelanggan->name }}</td>
                                <td>Rp {{number_format($order->total_price)}}</td>

                                <td> {{Carbon\Carbon::parse($order->created_at)->format('d F Y')}}</td>
                                <td><span class="badge badge-{{ $order->status_order == 'Processing' ? 'primary': ($order->status_order == 'Success' ? 'success':'danger')   }}">{{ $order->status_order }}</span></td>
                                <td>
                                    <a href="{{ route('transaksi.show', ['id' => $order->id]) }}" class='btn btn-success'><i class='ti ti-check'></i> Selesaikan Pesanan</a>
                                                         
                                </td>
                            </tr>
                            @endforeach
                            @forelse($orders as $order)
                            @empty
                            <tr class='text-center'>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Semua Transaksi </h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah data seluruh transaksi</p>
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
                                <th>Pelanggan</th>
                                <th>Total Harga</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                            
                            @foreach($transactions as $transaction)
                       
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>@foreach($transaction->order->detail as $detail) {{$detail->masakan->name}}, @endforeach</td>
                                <td>Meja {{ $transaction->order->meja->no_meja }}</td>
                                <td>{{ $transaction->order->pelanggan->name }}</td>
                                <td>Rp {{number_format($transaction->total_harga)}}</td>
                                <td> {{Carbon\Carbon::parse($transaction->created_at)->format('d F Y H:i')}}</td>

                                <td><span class="badge badge-{{ $transaction->status_order == 'Processing' ? 'primary': ($transaction->order->status_order == 'Success' ? 'success':'danger')      }}">{{ $transaction->order->status_order }}</span></td>
                           
                            </tr>
                            @endforeach
                            @forelse($transactions as $transaction)
                            @empty
                            <tr class='text-center'>
                                <td colspan="7">Tidak ada data</td>
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
@push('scripts')
    <script>
        function getData() {
            
        }
    </script>
@endpush
