@extends('layouts.dashboard')

@section('content')
    <div class="card" style="margin:30px; padding: 30px;">
        <div class="card-header">
            <h1>Dashboard</h1>
        </div>
        <div class="card-body">
            <h5>Selamat datang di SIM E-Office ITK.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-info py-2" style="margin:30px; padding: 30px;">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-dark  font-weight-bold text-xl mb-1">
                                <span>Jumlah Surat Belum Dibaca</span>
                            </div>
                            <div class="text-info font-weight-bold h1 mb-0">
                                <span>{{$letter_unread}}</span>
                            </div>
                        </div>
                        <div class="col-auto h1">
                            <i class="fas fa-inbox fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-warning py-2" style="margin:30px; padding: 30px;">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-dark font-weight-bold text-xl mb-1">
                                <span>Jumlah Surat Masuk</span>
                            </div>
                            <div class="text-warning font-weight-bold h1 mb-0">
                                <span>{{$letter_in}}</span>
                            </div>
                        </div>
                        <div class="col-auto h1">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-danger py-2" style="margin:30px; padding: 30px;">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-dark font-weight-bold text-xl mb-1">
                                <span>Jumlah Surat Keluar</span>
                            </div>
                            <div class="text-danger font-weight-bold h1 mb-0">
                                <span>{{$letter_out}}</span>
                            </div>
                        </div>
                        <div class="col-auto h1">
                            <i class="fas  fa-share-from-square fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-secondary py-2" style="margin:30px; padding: 30px;">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-secondary font-weight-bold text-xs mb-1">
                                <span>Status Surat Terkirim</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span>{{$letter_status_sent}}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-primary py-2" style="margin:30px; padding: 30px;">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                <span>Status Surat Dibaca</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span>{{$letter_status_read}}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-info py-2" style="margin:30px; padding: 30px;">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1">
                                <span>Status Surat Disposisi</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span>{{$letter_status_disposition}}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrows-up-to-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-success py-2" style="margin:30px; padding: 30px;">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                                <span>Status Surat Disetujui</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span>{{$letter_status_approved}}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-danger py-2" style="margin:30px; padding: 30px;">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-danger font-weight-bold text-xs mb-1">
                                <span>Status Surat Ditolak</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span>{{$letter_status_rejected}}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-xmark fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
