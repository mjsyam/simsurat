@extends('layouts.app')

@section('content')
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
        <div class="table-responsive">
            <h4 class="c-grey-900 mB-20">Data Akun {{ $user->name }}</h4>
            <div>
                <div class="col-lg-12 text-center mb-9">
                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Identifier User</span>
                </div>
                <div>
                    <div>
                        <div class="col-lg-12 text-center mb-9">
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Manajemen Identifier User</span>
                        </div>
                        <form method="POST" action="{{ route('admin.user.assignIdentifier', $user->id) }}">
                            @csrf
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">identifier</span>
                                </label>
                                <select class="drop-data form-select form-select-solid" name="identifiers[]" required
                                    multiple data-placeholder="Pilih identifier" data-allow-clear="true">
                                    @foreach ($identifiers as $identifier)
                                        <option value="{{ $identifier->id }}"
                                            {{ in_array($identifier->id, array_map(fn($item) => $item['id'], $user->identifiers->toArray())) ? 'selected' : ' ' }}">
                                            {{ $identifier->role->name }}-
                                            {{ $identifier->unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button>
                                Atur
                            </button>
                        </form>
                    </div>
                </div>
                <table class="table table-striped" id="sent_letter_table">
                    <thead>
                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                            <th>#</th>
                            <th>Role</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7">
                        @foreach ($user->identifiers as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->role->name }}
                                    {{ $data->role->parent ? ' - ' . $data->role->parent->name : '' }}</td>
                                <td>{{ $data->unit->name }}
                                    {{ $data->unit->parent ? ' - ' . $data->unit->parent->name : '' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('[name="identifiers[]"]').select2({
                theme: 'bootstrap5',
            });
            console.log(
                @foreach ($user->identifiers as $data)
                    {{ $data->id }},
                @endforeach );
            $('[name="identifiers[]"]').val([
                @foreach ($user->identifiers as $data)
                    {{ $data->id }},
                @endforeach
            ]).trigger('change');
        });
    </script>
@endsection
