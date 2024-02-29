@extends('layouts.dashboard')

@section('content')
    <div style="margin-left: 30px">

        <div class="row">
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-left-info py-2" style="margin-right: 10px; padding: 30px;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-dark  font-weight-bold text-xl mb-1">
                                    <span>Jumlah Surat Belum Dibaca</span>
                                </div>
                                <div class="text-info font-weight-bold h1 mb-0">
                                    <span>{{ $letter_unread }}</span>
                                </div>
                            </div>
                            <div class="col-auto h1">
                                <i class="fas fa-inbox fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-left-warning py-2" style="margin-right: 10px; padding: 30px;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-dark font-weight-bold text-xl mb-1">
                                    <span>Jumlah Surat Masuk</span>
                                </div>
                                <div class="text-warning font-weight-bold h1 mb-0">
                                    <span>{{ $letter_in }}</span>
                                </div>
                            </div>
                            <div class="col-auto h1">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-left-danger py-2" style="margin-right: 10px; padding: 30px;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-dark font-weight-bold text-xl mb-1">
                                    <span>Jumlah Surat Keluar</span>
                                </div>
                                <div class="text-danger font-weight-bold h1 mb-0">
                                    <span>{{ $letter_out }}</span>
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
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-left-secondary py-2" style="margin-right: 10px; padding: 30px;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-secondary font-weight-bold text-xs mb-1">
                                    <span>Status Surat Terkirim</span>
                                </div>
                                <div class="text-dark font-weight-bold h5 mb-0">
                                    <span>{{ $letter_status_sent }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-left-primary py-2" style="margin-right: 10px; padding: 30px;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                    <span>Status Surat Dibaca</span>
                                </div>
                                <div class="text-dark font-weight-bold h5 mb-0">
                                    <span>{{ $letter_status_read }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-eye fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-left-info py-2" style="margin-right: 10px; padding: 30px;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-info font-weight-bold text-xs mb-1">
                                    <span>Status Surat Disposisi</span>
                                </div>
                                <div class="text-dark font-weight-bold h5 mb-0">
                                    <span>{{ $letter_status_disposition }}</span>
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

        <style>
            .form-select {
                width: 70px !important;
            }
        </style>
        <div>
            <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
                <div class="table-responsive p-20">
                    <h3 class="">Surat Masuk</h3><br>
                    <table class="" id="inbox_table">
                        <thead>
                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                <th>#</th>
                                <th>Judul Surat</th>
                                <th>Ditanda tangani oleh</th>
                                <th>Kategori Surat</th>
                                <th>Tanggal diterbitkan</th>
                                <th class="w-100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-7">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            let inboxLettertable;
            let detailLetterTable;
            let sentLetterId;

            const onDetailButtonClick = (id) => {
                sentLetterId = id;
                detailLetterTable.draw();
            }


            $(document).ready(function() {
                inboxLettertable = $('#inbox_table').DataTable({
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    deferRender: true,
                    responsive: false,
                    aaSorting: [],
                    buttons: [],
                    language: {
                        "lengthMenu": "Show _MENU_",
                        "emptyTable": "Tidak ada data terbaru 📁",
                        "zeroRecords": "Data tidak ditemukan 😞",
                    },
                    dom: "<'row mb-2'" +
                        "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
                        "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
                        ">" +

                        "<'table-responsive'tr>" +

                        "<'row'" +
                        "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                        "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                        ">",
                    ajax: {
                        url: "{{ route('inbox.tableInbox') }}",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            searchable: false,
                        },
                        {
                            data: 'title'
                        },
                        {
                            data: 'signed'
                        },
                        {
                            data: 'category'
                        },
                        {
                            data: 'created_at'
                        },
                        {
                            data: 'action',
                            searchable: false,
                        },
                    ],
                    createdRow: function(row, data, dataIndex) {
                        const {
                            read
                        } = data;

                        if (!read) {
                            return $(row).css('background-color', 'rgb(255, 255, 255)');
                        } else {
                            return $(row).css('background-color', 'whitesmoke');
                        }
                    },
                });

                detailLetterTable = $('#table_detail')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        retrieve: true,
                        deferRender: true,
                        responsive: false,
                        aaSorting: [],
                        ajax: {
                            url: "{{ route('sent.letter-table-detail') }}",
                            data: function(data) {
                                data.id = sentLetterId
                            },
                        },
                        language: {
                            "lengthMenu": "Show _MENU_",
                            "emptyTable": "Tidak ada data terbaru 📁",
                            "zeroRecords": "Data tidak ditemukan 😞",
                        },
                        buttons: [],
                        dom: "<'row mb-2'" +
                            "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
                            "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
                            ">" +

                            "<'table-responsive'tr>" +

                            "<'row'" +
                            "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                            "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                            ">",

                        columns: [{
                                data: 'DT_RowIndex',
                                searchable: false,
                            },
                            {
                                data: "name"
                            },
                            {
                                data: "role"
                            },
                            {
                                data: "action",
                                searchable: false,
                            },
                        ],
                        columnDefs: [{
                            targets: [0],
                            className: 'text-center',
                        }],
                    });
            });
        </script>

        {{-- <div class="row">
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-left-success py-2" style="margin-right: 10px; padding: 30px;">
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

        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-left-danger py-2" style="margin-right: 10px; padding: 30px;">
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

    </div> --}}
    </div>
@endsection
