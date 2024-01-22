@extends('layouts.app')

@section('content')
    <style>
        .form-select {
            width: 70px !important;
        }
    </style>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div>
        <h3 class="">Surat Terkirim</h3><br>
        @if (Auth::user()->status == 'TENDIK')
            <div class="mb-4">
                <a href="{{ route('sent.letter-create') }}" class="btn btn-success px-7">
                    Buat Surat
                </a>
            </div>
        @endif
        <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
            <div class="table-responsive">
                <table class="table table-striped" id="sent_letter_table">
                    <thead>
                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                            <th>#</th>
                            <th>Judul Surat</th>
                            <th>Diterbitkan oleh</th>
                            <th>Dikirimkan ke</th>
                            <th>Ditanda tangani oleh</th>
                            <th>Kategori Surat</th>
                            <th>Tanggal diterbitkan</th>
                            <th class="w-100px">#</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7">
                    </tbody>
                </table>
            </div>
        </div>

        @include('sent-letter.modal.detail-modal')

        <script>
            let sentLetterTable;
            let detailLetterTable;
            let sentLetterId;

            const onDetailButtonClick = (id) => {
                sentLetterId = id;
                detailLetterTable.draw();
            }

            $(document).ready(function() {
                sentLetterTable = $('#sent_letter_table').DataTable({
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
                        url: "{{ route('sent.letter-table') }}"
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            searchable: false,
                        },
                        {
                            data: 'title'
                        },
                        {
                            data: 'user'
                        },
                        {
                            data: 'receiver'
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
    @endsection
