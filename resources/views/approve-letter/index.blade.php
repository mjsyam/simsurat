@extends('layouts.app')

@section('content')
<style>
    .form-select {
        width: 70px !important;
    }
</style>
    <div>
        <h3 class="">Surat yang perlu disetujui</h3><br>
        <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
            <div class="table-responsive">
                <table class="table table-striped" id="tb_approve">
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

    <script>
    $(document).ready(function() {
        const dataTableEpprove = $('#tb_approve').DataTable({
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
                url : "{{route('approve.letter.tableApprove')}}",
            },

            columns: [
            { data: 'DT_RowIndex', searchable : false,},
            { data: 'title'},
            { data: 'name'},
            { data: 'email'},
            { data: 'action', orderable : false, searchable : false,},
            ],
        });
    });
    </script>
@endsection
