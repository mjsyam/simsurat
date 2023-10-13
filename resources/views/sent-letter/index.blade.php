@extends('layouts.app')

@section('content')

<div>
    <h3 class="">Surat Terkirim</h3><br>
    <div class="mb-4">
        <a href="{{route('sent.letter-create')}}" class="btn btn-success px-7">
            Add
        </a>
    </div>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
        <div class="table-responsive">
            <table class="table table-striped" id="sent_letter_table">
                <thead>
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th>#</th>
                        <th>Judul Surat</th>
                        <th>Kategori Surat</th>
                        <th>Tanggal dibuat</th>
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
            aaSorting : [],
            buttons: [],
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            dom:
            "<'row mb-2'" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
            "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
            ">",
            ajax: {
                url : "{{route('sent.letter-table')}}"
            },

            columns: [
            { data: 'DT_RowIndex'},
            { data: 'title'},
            { data: 'category'},
            { data: 'created_at'},
            { data: 'action'},
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

                columns: [
                    { data: 'DT_RowIndex'},
                    { data: "name" },
                    { data: "role" },
                    // { data: "identifier" },
                ],
                columnDefs: [{
                    targets: [0],
                    className: 'text-center',
                }],
            });
    });
</script>
@endsection
