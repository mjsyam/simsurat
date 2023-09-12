@extends('layouts.app')

@section('content')
    <div>
        <div class="col-md-9">
            <form method="POST" action="{{ route('sent.letter-store') }}" class="card shadow mb-4">
                @csrf
                <a href="#axe3" class="d-block card-header py-3 align-items-center d-flex" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="axe3">
                    <h6 class="m-0 font-weight-bold">Data Surat Keluar</h6>
                </a>

                <div class="collapse show" id="axe3">
                    <div class="card-body">

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="letter_category_id">Kategori Surat *</label>
                                <select class="form-select" name="letter_category_id" aria-label="Default select example">
                                    @foreach ($letterCategories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="institution" class="required">Institusi</label>
                                <div class="input-group mb-3">
                                    <input id="institution" type="text" name="institution"
                                        class="form-control @error('institution') is-invalid @enderror"
                                        autocomplete="institution" value="{{ old('institution') }}" required>
                                </div>
                                <small id="institution" class="form-text text-muted">Contoh : lembaga penelitian dan pengabdian masyarakat</small>
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
                                <label for="refrences_number" class="required">Nomor Surat</label>
                                <div class="input-group mb-3">
                                    <input id="refrences_number" type="text"
                                        class="form-control @error('refrences_number') is-invalid @enderror" name="refrences_number"
                                        autocomplete="no_surat" value="{{ old('refrences_number') }}" required>
                                </div>
                                <small id="refrences_number" class="form-text text-muted">Contoh : JMTI/SK/0112/08/2021</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="letter_destination">Tujuan Surat (Tertulis)</label>
                                <div class="input-group mb-3">
                                    <input id="letter_destination" type="text"
                                        class="form-control @error('letter_destination') is-invalid @enderror" name="letter_destination"
                                        autocomplete="no_surat" value="{{ old('letter_destination') }}">
                                </div>
                                <small id="letter_destination" class="form-text text-muted">Contoh : Bapak/Ibu Dosen</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="body" class="required">Isi Surat</label>
                                <div class="input-group mb-3">
                                    <textarea id="body" type="text"
                                        class="form-control editor @error('body') is-invalid @enderror" name="body">
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="signed">Bertanda tangan</label>
                                <select class="form-select" name="signed">
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} | {{$user->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="role_id">Sebagai</label>
                                <select class="form-select" name="role_id">
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="receivers">Penerima Surat</label>
                                <select class="form-select" name="receivers[]" multiple>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} | {{$user->email}}</option>
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
    <script src="{{ asset("ckeditor/ckeditor.js") }}"></script>
    <script>
        $(document).ready(function() {
            function loadOptions(selectedValue) {
                $.ajax({
                    url: '{{ route("user.get-role") }}',
                    dataType: 'json',
                    data: {
                        id: selectedValue,
                    },
                    success: function (data) {
                        $('[name="role_id"]').empty();

                        $('[name="role_id"]').select2({
                            data: data.data
                        });
                    }
                });
            }

            $('[name="receivers[]"]').select2();
            $('[name="signed"]').select2();

            $('[name="signed"]').on('change', function () {
                var selectedValue = $(this).val();
                loadOptions(selectedValue);
            });

            $('[name="signed"]').trigger('change');

            ClassicEditor
            .create(document.querySelector('.editor'))
            .catch(error => {
                console.error(error);
            });
        });
    </script>
@endsection
