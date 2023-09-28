@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Histori</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Histori Pembayaran UDB</div>

                    @foreach ($pembayaranudb as $value)
                        <div class="border-top">
                            <div class="float-right">
                                <i class="mdi mdi-check text-success"></i> {{ $value->created_at->format('d M, Y') }}
                            </div>
                            <div class="mt-4 text-uppercase">
                                {{ $value->siswa->nama . ' - ' . $value->siswa->kelas->nama_kelas }}
                            </div>
                            <div>UDB Bulan <b class="text-capitalize">{{ $value->udb_bulan }}</b></div>
                            <div>Nominal UDB Rp.{{ $udb = $value->siswa->udb->nominal }}</div>
                            <div>Bayar Rp.{{ $bayar = $value->jumlah_bayar }}</div>
                            <div>Tunggakan Rp.{{ $udb - $bayar }}</div>
                            <a href="{{ url('dashboard/historyudb/create') }}" class="mt-3 btn btn-success" target="_blank">
                                Print Kwitansi</a>
                        </div>
                    @endforeach
                    <!-- Pagination -->
                    @if ($pembayaranudb->lastPage() != 1)
                        <div class="btn-group float-right">
                            <a href="{{ $pembayaranudb->previousPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                            @for ($i = 1; $i <= $pembayaranudb->lastPage(); $i++)
                                <a class="btn btn-success {{ $i == $pembayaranudb->currentPage() ? 'active' : '' }}"
                                    href="{{ $pembayaranudb->url($i) }}">{{ $i }}</a>
                            @endfor
                            <a href="{{ $pembayaranudb->nextPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>

                        </div>
                    @endif
                    <!-- End Pagination -->

                    @if (count($pembayaranudb) == 0)
                        <div class="text-center">Tidak ada histori pembayaran</div>
                    @endif

                </div>
            </div>

        </div>
    </div>

@endsection
