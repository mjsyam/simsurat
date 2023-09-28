@extends('layouts.app')

@section('content')
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
        <div class="table-responsive">
            <h4 class="c-grey-900 mB-20">User dengan Role {{ $role->name }}</h4>
            <div>
                <div>
                    <form method="POST" action="{{ route('admin.role.assignUser', $role->name) }}">
                        @csrf
                        <label>
                            Tambah User
                        </label>
                        <select class="form-select" name="user_id" aria-label="Default select example">
                            @foreach ($not_assigned_users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button>
                            Tambah
                        </button>
                    </form>
                </div>
                <div>
                    <form method="POST" action="{{ route('admin.role.removeUser', $role->name) }}">
                        @csrf
                        <label>
                            Hapus User
                        </label>
                        <select class="form-select" name="user_id" aria-label="Default select example">
                            @foreach ($users as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <button>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            <table class="table table-striped" id="sent_letter_table">
                <thead>
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th>#</th>
                        <th>nama</th>
                        <th>email</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                    @foreach ($users as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
