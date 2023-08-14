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
                            <th>Nomor Surat</th>
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

    <script>
        $(document).ready(function() {
            const dataTableEpprove = $('#tb_family_content').DataTable({
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
                    url : "{{route('approve.tableApprove')}}",
                },

                columns: [
                { data: 'DT_RowIndex'},
                { data: 'title'},
                { data: 'name'},
                { data: 'email'},
                { data: 'action'},
                ],
            });
        });
        </script>
@endsection
