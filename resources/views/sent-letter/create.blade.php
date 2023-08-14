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
                                <label for="no_surat">Judul Surat *</label>
                                <div class="input-group mb-3">
                                    <input id="title" type="text" name="title"
                                        class="form-control @error('no_surat') is-invalid @enderror" name="no_surat"
                                        autocomplete="no_surat" value="{{ old('no_surat') }}" required>
                                </div>
                                <small id="no_surat" class="form-text text-muted">Contoh : Surat Undangan 17 Agustus</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="refrences_number">Nomor Surat *</label>
                                <div class="input-group mb-3">
                                    <input id="refrences_number" type="text"
                                        class="form-control @error('no_surat') is-invalid @enderror" name="refrences_number"
                                        autocomplete="no_surat" value="{{ old('no_surat') }}" required>
                                </div>
                                <small id="no_surat" class="form-text text-muted">Contoh : JMTI/SK/0112/08/2021</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="letter_destination">Tujuan Surat (Tertulis)</label>
                                <div class="input-group mb-3">
                                    <input id="letter_destination" type="text"
                                        class="form-control @error('no_surat') is-invalid @enderror" name="letter_destination"
                                        autocomplete="no_surat" value="{{ old('no_surat') }}">
                                </div>
                                <small id="no_surat" class="form-text text-muted">Contoh : Bapak/Ibu Dosen</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="body">Isi Surat *</label>
                                <div class="input-group mb-3">
                                    <input id="body" type="text"
                                        class="form-control @error('no_surat') is-invalid @enderror" name="body"
                                        autocomplete="no_surat" value="{{ old('no_surat') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="sender">Pengirim Surat (Tertulis)</label>
                                <div class="input-group mb-3">
                                    <input id="sender" type="text"
                                        class="form-control @error('no_surat') is-invalid @enderror" name="sender"
                                        autocomplete="no_surat" value="{{ old('no_surat') }}">
                                </div>
                                <small id="no_surat" class="form-text text-muted">Contoh : JMTI/SK/0112/08/2021</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-8">
                                <label for="receivers">Penerima Surat</label>
                                <select class="form-select" name="receivers[]" multiple="multiple">
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <small id="no_surat" class="form-text text-muted">Contoh : JMTI/SK/0112/08/2021</small>
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
