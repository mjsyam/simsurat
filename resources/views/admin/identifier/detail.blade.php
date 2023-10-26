@extends('layouts.app')

@section('content')
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
        <div class="table-responsive">
            <h4 class="c-grey-900 mB-20">Identifier {{ $identifier->role->name }} - {{ $identifier->unit->name }}</h4>
            <div>
                <div>
                    <form method="POST" action="{{ route('admin.identifier.assignUser', $identifier->id) }}">
                        @csrf
                        <label>
                            Tambah User
                        </label>
                        <label>
                            Role Akun
                        </label>
                        <select class="form-select" name="role_id" aria-label="Default select example">
                            @foreach ($unassigned_users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button>
                            Tambah
                        </button>
                    </form>
                </div>
                <div>
                    <form method="POST" action="{{ route('admin.identifier.removeUser', $identifier->id) }}">
                        @csrf
                        <label>
                            Hapus User
                        </label>
                        <label>
                            Role Akun
                        </label>
                        <select class="form-select" name="role_id" aria-label="Default select example">
                            @foreach ($assigned_users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            <h3 class="c-grey-900 mB-20">Identifier User</h4>

            <table class="table table-striped" id="sent_letter_table">
                <thead>
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th>#</th>
                        <th>nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                    @foreach ($identifier->users as $data)
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
