@extends('layouts.app')

@section('content')
    <div>
        <div class="col-md-9">
            <form method="POST" action="{{ route('sent.letter-store') }}" class="card shadow mb-4" enctype="multipart/form-data">
                @csrf
                <a href="#axe3" class="d-block card-header py-3 align-items-center d-flex" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="axe3">
                    <h6 class="m-0 font-weight-bold">Data Surat Keluar</h6>
                </a>

                <div class="collapse show" id="axe3">
                    <div class="card-body">

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="letter_category_id" class="required">Kategori Surat</label>
                                <select class="form-select" name="letter_category_id" aria-label="Default select example">
                                    @foreach ($letterCategories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="title" class="required">Judul Surat</label>
                                <div class="input-group mb-3">
                                    <input id="title" type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        autocomplete="title" value="{{ old('title') }}" required>
                                </div>
                                <small id="title" class="form-text text-muted">Contoh : Surat Undangan 17 Agustus</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="date" class="required">Tanggal Surat</label>
                                <div class="input-group mb-3">
                                    <input id="date" type="date" name="date"
                                        class="form-control @error('date') is-invalid @enderror"
                                        autocomplete="date" value="{{ old('date') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="file" class="required">File</label>
                                <div class="input-group mb-3">
                                    <input id="file" type="file" name="file"
                                        class="form-control @error('file') is-invalid @enderror"
                                        autocomplete="file" value="{{ old('file') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="signed">Bertanda tangan</label>
                                <select class="form-select" name="signed">
                                    @foreach($signed as $modelHasRole)
                                        <option value="{{$modelHasRole->user->id}}-{{$modelHasRole->role->id}}-{{$modelHasRole->unit->id}}">
                                            {{$modelHasRole->user->name}} | {{$modelHasRole->role->name}} {{$modelHasRole->unit->name}}
                                        </option>
                                    @endforeach


                                 
                                </select>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="role_id">Sebagai</label>
                                <select class="form-select" name="role_id">
                                </select>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="receivers">Penerima Surat</label>
                                <select class="form-select" name="receivers[]" multiple>
                                    @foreach ($users as $user)
                                        @foreach ($user->modelHasRoles as $modelHasRole)
                                            <option value="{{$user->id}}-{{$modelHasRole->role->id}}-{{$modelHasRole->unit->id ?? ''}}">
                                                {{$user->name}} | {{$modelHasRole->role->name}} {{$modelHasRole->unit->name ?? ''}}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0 pr-3">
                            <div class="col-md-1 align-self-end ml-auto">
                                <button type="submit"class="btn btn-lg btn-success pull-right" style="float: right;">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // function loadOptions(selectedValue) {
            //     $.ajax({
            //         url: '{{ route("user.get-role") }}',
            //         dataType: 'json',
            //         data: {
            //             id: selectedValue,
            //         },
            //         success: function (data) {
            //             $('[name="role_id"]').empty();

            //             $('[name="role_id"]').select2({
            //                 data: data.data
            //             });
            //         }
            //     });
            // }

            $('[name="receivers[]"]').select2();
            $('[name="signed"]').select2();

            // $('[name="signed"]').on('change', function () {
            //     var selectedValue = $(this).val();
            //     loadOptions(selectedValue);
            // });

            // $('[name="signed"]').trigger('change');
        });
    </script>
@endsection
