@extends('layouts.app')

@section('content')
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
        <div class="table-responsive">
            <h4 class="c-grey-900 mB-20">User dengan Unit Kerja {{ $unit->name }}</h4>
            <div>
                <div>
                    <form method="POST" action="{{ route('admin.unit.assignIdentifier', $unit->id) }}">
                        @csrf
                        <label>
                            Tambah Identifier
                        </label>
                        <label>
                            Role Akun
                        </label>
                        <select class="form-select" name="role_id" aria-label="Default select example">
                            @foreach ($roles as $role)
                                 <option value="{{ $role->id }}">{{ $role->name }}
                                    {{ $role->parent ? ' - ' . $role->parent->name : '' }}</option>
                            @endforeach
                        </select>
                        <button>
                            Tambah
                        </button>
                    </form>
                </div>
                <div>
                    <form method="POST" action="{{ route('admin.unit.removeIdentifier', $unit->id) }}">
                        @csrf
                        <label>
                            Hapus Identifier
                        </label>
                         <label>
                            Role Akun
                        </label>
                        <select class="form-select" name="role_id" aria-label="Default select example">
                            @foreach ($identifiers as $data)
                                <option value="{{ $data->role_id }}">{{ $data->role->name }}</option>
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
                        <th>Induk</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                   @foreach ($identifiers as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->role->name }}</td>
                            <td>{{ $data->role->parent ? $data->role->parent->name : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
