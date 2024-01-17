@extends('layouts.app')

@section('content')
    <style>
        .form-select {
            width: 70px !important;
        }
    </style>
    <div>
        <h3 class="">Surat Masuk</h3><br>
        <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
            <div class="table-responsive">
                <table class="table table-striped" id="inbox_table">
                    <thead>
                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                            <th>#</th>
                            <th>Judul Surat</th>
                            <th>Pengirim</th>
                            <th>Email</th>
                            <th class="w-100px">#</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('sent-letter.modal.detail-modal')

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
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'action'
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
                            data: 'DT_RowIndex'
                        },
                        {
                            data: "name"
                        },
                        {
                            data: "role"
                        },
                        {
                            data: "action"
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
