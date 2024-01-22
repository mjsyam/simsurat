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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="very-soon-tab" data-bs-toggle="tab" data-bs-target="#very-soon-tab-pane"
                    type="button" role="tab" aria-controls="very-soon-tab-pane" aria-selected="false">Sangat
                    Segera</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="soon-tab" data-bs-toggle="tab" data-bs-target="#soon-tab-pane"
                    type="button" role="tab" aria-controls="soon-tab-pane" aria-selected="false">Segera</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="common-tab" data-bs-toggle="tab" data-bs-target="#common-tab-pane"
                    type="button" role="tab" aria-controls="common-tab-pane" aria-selected="false">Biasa</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="secret-tab" data-bs-toggle="tab" data-bs-target="#secret-tab-pane"
                    type="button" role="tab" aria-controls="secret-tab-pane" aria-selected="false">Rahasia</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="very-secret-tab" data-bs-toggle="tab" data-bs-target="#very-secret-tab-pane"
                    type="button" role="tab" aria-controls="very-secret-tab-pane" aria-selected="true">Sangat Rahasia</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="very-soon-tab-pane" role="tabpanel" aria-labelledby="very-soon-tab"
                tabindex="0">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="received_letter_table">
                            <thead>
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th>#</th>
                                    <th>Nomor Surat</th>
                                    <th>Judul Surat</th>
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
            <div class="tab-pane fade" id="soon-tab-pane" role="tabpanel" aria-labelledby="soon-tab" tabindex="1">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="received_letter_table">
                            <thead>
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th>#</th>
                                    <th>Nomor Surat</th>
                                    <th>Judul Surat</th>
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
            <div class="tab-pane fade" id="common-tab-pane" role="tabpanel" aria-labelledby="common-tab" tabindex="2">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="received_letter_table">
                            <thead>
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th>#</th>
                                    <th>Nomor Surat</th>
                                    <th>Judul Surat</th>
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
            <div class="tab-pane fade" id="secret-tab-pane" role="tabpanel" aria-labelledby="secret-tab" tabindex="3">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="received_letter_table">
                            <thead>
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th>#</th>
                                    <th>Nomor Surat</th>
                                    <th>Judul Surat</th>
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
            <div class="tab-pane fade" id="very-secret-tab-pane" role="tabpanel" aria-labelledby="very-secret-tab"
                tabindex="4">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="received_letter_table">
                            <thead>
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th>#</th>
                                    <th>Nomor Surat</th>
                                    <th>Judul Surat</th>
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
        // $(document).ready(function() {
        //     const dataTableEpprove = $('#received_letter_table').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         retrieve: true,
        //         deferRender: true,
        //         responsive: false,
        //         aaSorting : [],
        //         buttons: [],
        //         language: {
        //             "lengthMenu": "Show _MENU_",
        //             "emptyTable" : "Tidak ada data terbaru 📁",
        //             "zeroRecords": "Data tidak ditemukan 😞",
        //         },
        //         dom:
        //        "<'row mb-2'" +
        //         "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
        //         "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
        //         ">" +

        //         "<'table-responsive'tr>" +

        //         "<'row'" +
        //         "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
        //         "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
        //         ">",
        //         ajax: {
        //             url : "{{ route('received.letter-table') }}",
        //         },

        //         columns: [
        //         { data: 'DT_RowIndex'},
        //         { data: 'refrences_number'},
        //         { data: 'title'},
        //         { data: 'category'},
        //         { data: 'created_at'},
        //         { data: 'action'},
        //         ],
        //     });
        // });
    </script>
@endsection
