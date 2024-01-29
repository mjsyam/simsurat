@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    <style>
        .form-select {
            width: 70px !important;
        }
    </style>
    <div>
        <h3 class="">Disposisi Masuk</h3><br>
        <div class="d-flex justify-content-end align-items-center">
            <label for="letter_category_id" class="me-3">Tingkat Kerahasiaan</label>
            <select class="form-select" aria-label="Default select example" style="min-width: 200px;" id="security_filter">
                <option value="*">Semua</option>
                @foreach ($security as $security)
                    <option value="{{ $security }}">{{ $security }}</option>
                @endforeach
            </select>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="very-soon-tab-pane" role="tabpanel" aria-labelledby="very-soon-tab"
                tabindex="0">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="inbox_disposition">
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
            const dataTableEpprove = $('#inbox_disposition').DataTable({
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
                    url : "{{ route('inbox.tableDisposisitionInbox') }}",
                    data: function (d) {
                        d.security_filter = $('#security_filter').val();
                    }
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

        $('#security_filter').on('change', function () {
            $('#inbox_disposition').DataTable().ajax.reload();
        });
    </script>
@endsection
