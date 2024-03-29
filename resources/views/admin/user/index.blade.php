@extends('layouts.app')

@section('content')
    @include('admin.user.components.add-modal')
    @include('admin.user.components.delete-modal')
    @include('admin.user.components.edit-modal')
    <style>
        .form-select {
            width: 70px !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div>
        <h3 class="">Users</h3><br>
        <div class="mb-4">
            <a href="#add_user_modal" class="dropdown-item py-2 btn btn-success px-7" style="width: 80px"
                data-bs-toggle="modal">
                Add
            </a>
        </div>
        <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
            <div class="table-responsive">
                <table class="table table-striped" id="user_table">
                    <thead>
                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                            <th class="w-100px">#</th>
                            <th class="w-250px">Name</th>
                            <th class="w-250px">Email</th>
                            <th class="w-250px">Status</th>
                            <th class="w-250px">Created At</th>
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
        const onEditUserModalOpen = ({
            id,
            name,
            number,
            status,
            email,
            phone_number,
            unit_id
        }) => {
            $('#edit_user_modal_form [name="id"]').val(id);
            $('#edit_user_modal_form [name="name"]').val(name);
            $('#edit_user_modal_form [name="email"]').val(email);
            $('#edit_user_modal_form [name="status"]').val(status);
            $('#edit_user_modal_form [name="number"]').val(number);
            $('#edit_user_modal_form [name="phone_number"]').val(phone_number);
            $('#edit_user_modal_form [name="unit_id"] option').map(function() {
                console.log(unit_id);
                if ($(this).val() == unit_id) {
                    $(this).attr('selected', 'selected');
                }
            });
        };

        const onDeleteUserModalOpen = ({
            id,
            name,
        }) => {
            $('#delete_user_modal_form [name="id"]').val(id);
            $('#delete_user_modal_form [name="name"]').val(name);
        };

        $(document).ready(function() {
            const userTable = $('#user_table').DataTable({
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
                    url: "{{ route('admin.user.table') }}",
                },

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        searchable: false,
                    },
                ],

                columnDefs: [{
                    targets: [0],
                    className: 'text-center',
                }, ],
            });

            $('#add_user_modal_form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.user.add') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        userTable.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });

            $('#edit_user_modal_form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                console.log(formData)
                $.ajax({
                    url: "{{ route('admin.user.update', 'formData.attr.id') }}",
                    type: 'PUT',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        userTable.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });

            $('#delete_user_modal_form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                console.log(formData)

                $.ajax({
                    url: "{{ route('admin.user.delete', 'formData.attr.id') }}",
                    type: 'DELETE',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        userTable.ajax.reload();
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
