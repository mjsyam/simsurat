@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    <style>
        .form-select {
            width: 70px !important;
        }
    </style>
    <div>
        <h3 class="">Disposisi Keluar</h3><br>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="very-soon-tab-pane" role="tabpanel" aria-labelledby="very-soon-tab"
                tabindex="0">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="outbox_disposition">
                            <thead>
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th>#</th>
                                    <th>Judul Surat</th>
                                    <th>Tingkat Kerahasian</th>
                                    <th>Bertanda Tangan</th>
                                    <th>Kategori Surat</th>
                                    <th>Tanggal dibuat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            const dataTableEpprove = $('#outbox_disposition').DataTable({
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
                    url : "{{ route('inbox.tableOutboxDisposition') }}",
                },

                columns: [
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'security_level'
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
        });
    </script>
@endsection
