@extends('layouts.app')

@section('content')
<div>
    Name : {{$role->role}}
</div>

<div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
    <div class="table-responsive">
        <h4 class="c-grey-900 mB-20">User dengan Role {{$role->role}}</h4>
        <div>
            <div>
                <form method="POST" action="{{ route('admin.role.assignUser',$role->id) }}">
                    @csrf
                    <label>
                        Tambah User
                    </label>
                    <select class="form-select" name="user_id" aria-label="Default select example">
                        @foreach ($not_assigned_users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    <button>
                        Tambah
                    </button>
                </form>
            </div>
            <div>
                <form method="POST" action="{{ route('admin.role.removeUser',$role->id) }}">
                    @csrf
                    <label>
                        Hapus User
                    </label>
                    <select class="form-select" name="user_id" aria-label="Default select example">
                        @foreach ($role->userRoles as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
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
                @foreach ($role->userRoles as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
