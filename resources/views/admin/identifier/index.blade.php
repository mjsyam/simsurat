@extends('layouts.app')

@section('content')
    @include('admin.identifier.components.add-modal')
    @include('admin.identifier.components.delete-modal')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div>
        <h3 class="">Identifiers</h3><br>
        <div class="mb-4">
            <a href="#add_identifier_modal" class="dropdown-item py-2 btn btn-success px-7" data-bs-toggle="modal">
                Add
            </a>
        </div>
        <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
            <div class="table-responsive">
                <table class="table table-striped" id="identifier_table">
                    <thead>
                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                            <th class="w-100px">#</th>
                            <th class="w-250px">Role</th>
                            <th class="w-250px">Unit</th>
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
        const onDeleteIdentifierModalOpen = ({
            id,
        }) => {
            $('#delete_identifier_modal_form [name="id"]').val(id);
        };

        $(document).ready(function() {
            const identifierTable = $('#identifier_table').DataTable({
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
                    url: "{{ route('admin.identifier.table') }}",
                },

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'role'
                    },
                    {
                        data: 'unit'
                    },
                    {
                        data: 'action'
                    },
                ],

                columnDefs: [{
                    targets: [0],
                    className: 'text-center',
                }, ],
            });

            $('#add_identifier_modal_form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.identifier.add') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        identifierTable.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });

            $('#delete_identifier_modal_form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                console.log(formData)
                $.ajax({
                    url: "{{ route('admin.identifier.delete', 'formData.attr.id') }}",
                    type: 'DELETE',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        identifierTable.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });
        });
    </script>
@endsection
