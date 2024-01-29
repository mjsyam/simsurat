@extends('layouts.app')

@section('css')
    <style>
        .letter-content,
        td {
            border: 1px solid black;
            padding: 2px 5px;
        }

        .bgTable {
            background-color: #409CF2;
            color: white;
        }

        .bgButton {
            background-color: #409CF2;
            color: white;
        }

        .bgButton:hover {
            background-color: #5da8ee;
        }
    </style>
@endsection

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="container-fluid">
        <h2 style="color: #515151" class="font-weight-bold">Detail Surat</h2>
        <h5 style="color: gray" class="font-weight-bold">Sisukma Institut Teknologi Kalimantan</h5>
        @if ($dispositionStatus)
            @if ($dispositionStatus->status == 'process')
                <div class="alert alert-info my-3" role="alert">
                    <h3 class="alert-heading">Berikan Status surat</h3>
                    <div class="my-3">
                        <form method="POST" action="{{ route('inbox.disposition.status',  ['dispositionTo' => $dispositionStatus->id, 'status' => 'approved']) }}" style="display: inline-block">
                            @csrf
                            <button type="submit" class="btn btn-success">Disetujui</button>
                        </form>
                        <form method="POST" action="{{ route('inbox.disposition.status', ['dispositionTo' => $dispositionStatus->id, 'status' => 'rejected']) }}" style="display: inline-block">
                            @csrf
                            <button type="submit" class="ml-2 btn btn-danger">Ditolak</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert @if($dispositionStatus->status == 'approved') alert-success @else alert-danger @endif" role="alert">
                    Surat telah <b>@if($dispositionStatus->status == "approved") Disetujui @else Ditolak @endif</b> oleh Anda.
                </div>
            @endif
        @endif
    </div>


    @if ($disposition)
        <div class="container-fluid">
            <hr style="margin-top: 1rem; margin-bottom: 1rem; border: 0; border-top: 1px solid black">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>
                                    <p class="ml-3 my-auto">Sifat</p>
                                </td>
                                <td>
                                    <span class="badge badge-warning">
                                        {{ $disposition->security_level }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="ml-3 my-auto">Diterima</p>
                                </td>
                                <td>
                                    <p class="ml-3 my-auto">
                                        {{ Carbon::parse($disposition->receive_date)->format('d  M  Y') }}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped">
                        <thead class="bgTable">
                            <tr>
                                <td colspan="2">
                                    <h5 class="ml-3 my-auto text-white">Status Surat</h5>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="ml-3 my-auto">Berkas</p>
                                </td>
                                <td>
                                    <p class="ml-3 my-auto">-</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="ml-3 my-auto">Sifat</p>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Verifikasi JMTI</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="ml-3 my-auto">Diterima</p>
                                </td>
                                <td>
                                    <p class="ml-3 my-auto">
                                        {{ Carbon::parse($disposition->receive_date)->format('d  M  Y') }}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead class="bgTable">
                        <tr>
                            <td colspan="2">
                                <h5 class="ml-3 my-auto text-white">Informasi Detail Surat</h5>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($disposition)
                            <tr>
                                <td>
                                    <p class="ml-3 my-auto">Instansi</p>
                                </td>
                                <td>
                                    <p class="ml-3 my-auto">
                                        {{ $disposition->from }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="ml-3 my-auto">Perihal</p>
                                </td>
                                <td>
                                    <p class="ml-3 my-auto">
                                        {{ $disposition->point }}
                                    </p>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>
                                <p class="ml-3 my-auto">Kategori Surat</p>
                            </td>
                            <td>
                                <p class="ml-3 my-auto">
                                    {{ $letter->letterCategory->name }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="ml-3 my-auto">Title</p>
                            </td>
                            <td>
                                <p class="ml-3 my-auto">
                                    {{ $letter->title }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="ml-3 my-auto">Yang bertanda tangan</p>
                            </td>
                            <td>
                                <p class="ml-3 my-auto">
                                    {{ $letter->signed->name }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="ml-3 my-auto">Disposisi</p>
                            </td>
                            <td>
                                <ul>
                                    @if ($disposition)
                                        @foreach ($disposition->dispositionTos as $dispositionTos)
                                            <li>{{ $dispositionTos->role->name }} - @if($dispositionTos->status == "process") Diproses @elseif($dispositionTos->status == "approved") Disetujui @else Ditolak @endif</li>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="ml-3 my-auto">Tanggal</p>
                            </td>
                            <td>
                                <p class="ml-3 my-auto">
                                    {{ Carbon::parse($letter->date)->format('d  M  Y') }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="ml-3 my-auto">File</p>
                            </td>
                            <td>
                                <p class="ml-3 my-auto">
                                    <a href="{{ asset("/storage/letter/$letter->file") }}" class="btn text-white bgButton">
                                        <i class="fa-solid text-white fa-eye me-3"></i>
                                        Preview
                                    </a>
                                    {{-- <button type="button" class="btn text-white bgButton"
                                            data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa-solid text-white fa-eye me-3"></i>
                                            Download
                                        </button> --}}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($disposition == null)
        </div>
        </div>
        <div class="card" style="margin:30px; padding: 30px;">
            <div class="card-body">
                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="color: #515151" class="font-weight-bold">Disposisi Surat</h2>
                            <h6 style="color: gray">Lakukan <span class="font-weight-bold">disposisi</span> jabatan untuk
                                diteruskan kepada unit lain. Berikan
                                catatan
                                tindakan
                                untuk informasi tambahan</h6>
                        </div>
                    </div>
                </div>
                <div class="mb-2 py-5">
                    <form action="{{ route('inbox.disposition', ['letterReceiver' => $letterReceiver->id]) }}"
                        method="POST">
                        @method('POST')
                        @csrf
                        <div class="container-fluid">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="agenda" class="form-label">Tingkat kerahasiaan</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select form-select-sm" name="security_level"
                                        @if ($disposition) disabled @endif>
                                        @foreach ($security as $security)
                                            <option value="{{ $security }}"
                                                @if ($disposition) disabled @endif
                                                @if ($disposition && $disposition->security_level == $security) selected @endif>{{ $security }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="agenda" class="form-label">Diteruskan Kepada :</label>
                                </div>
                                <div class="col-md-9">
                                    @if (!$disposition)
                                        <select name="roles[]" id="roles" multiple>
                                            @foreach ($roles as $role)
                                            @endforeach
                                        </select>
                                    @else
                                        <ul>
                                            @foreach ($disposition->dispositionTos as $dispositionTos)
                                                <li>{{ $dispositionTos->user->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="agenda" class="form-label">Untuk :</label>
                                </div>
                                <div class="col-md-9">
                                    @if (!$disposition)
                                        <select name="informations[]" id="informations" multiple required>
                                            @foreach ($informations as $information)
                                            @endforeach
                                        </select>
                                    @else
                                        <div>
                                            <ul>
                                                @foreach ($disposition->DispositionInformations as $dispositionInformation)
                                                    <li>{{ $dispositionInformation->information }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        {{-- <div class="alert alert-primary" role="alert">
                                    Surat telah terdisposisi
                                </div> --}}
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="agenda" class="form-label">Deskripsi</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="description" class="form-control" rows="4" @if ($disposition) disabled @endif>
@if ($disposition)
{{ $disposition->information }}
@endif
</textarea>
                                </div>
                            </div>
                            @if (!$disposition)
                                <div class="row">
                                    <div class="col-md-10"></div>
                                    <div class="col-md-2 text-right">
                                        <button class="btn btn-success">Disposisi</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
    @endif
@endsection

@section('script')
    <script>
        var selectDisposition = document.querySelector("#roles");

        const roles = @json($roles);
        roles.forEach(role => {
            // if (user.id != {{ Auth::user()->id }} && user.id != {{ $letter->user_id }}) {
            var option = document.createElement("option");
            option.value = role.id;
            option.text = role.name;
            selectDisposition.appendChild(option);
            // }
        });

        var data = [];

        var placeholder = "select";
        $("#roles").select2(selectDisposition, {
            data: data.map(function(item) {
                return {
                    id: item,
                    text: item
                };
            }),
            placeholder: placeholder,
            allowClear: false,
            minimumResultsForSearch: 5
        });


        var selectDisposition = document.querySelector("#informations");

        const informations = @json($informations);
        informations.forEach(information => {
            // if (user.id != {{ Auth::user()->id }} && user.id != {{ $letter->user_id }}) {
            var option = document.createElement("option");
            option.value = information;
            option.text = information;
            selectDisposition.appendChild(option);
            // }
        });

        var data = [];

        var placeholder = "select";
        $("#informations").select2(selectDisposition, {
            data: data.map(function(item) {
                return {
                    id: item,
                    text: item
                };
            }),
            placeholder: placeholder,
            allowClear: false,
            minimumResultsForSearch: 5
        });
    </script>
@endsection
