@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">UDB - UDT</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">{{ __('Edit UDB') }}</div>

                    <form method="post" action="{{ url('/dashboard/data-udb', $edit->id) }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label>Bulan</label>
                            <input type="text" class="form-control @error('bulan') is-invalid @enderror" name="bulan"
                                value="{{ $edit->bulan }}">
                            <span class="text-danger">
                                @error('bulan')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal"
                                value="{{ $edit->nominal }}">
                            <span class="text-danger">
                                @error('nominal')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <a href="{{ url('dashboard/data-spp') }}" class="btn btn-primary btn-rounded">
                            <i class="mdi mdi-chevron-left"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-success btn-rounded  float-right">
                            <i class="mdi mdi-check"></i> Simpan
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
