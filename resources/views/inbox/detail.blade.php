@extends('layouts.app')

@section('css')
    <style>
        .letter-content,
        td {
            border: 1px solid black;
            padding: 2px 5px;
        }
    </style>
@endsection

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="mb-2 py-5 px-4">
        <div class="d-flex justify-content-between">
            <div>
                <h1>Detail</h1>
            </div>
            <div>
                <a href="{{ asset("/storage/letter/$letter->file") }}" class="btn btn-success">Lihat Surat</a>
            </div>
        </div>
        <hr style="height: 2px; background-color:black">
        <form action="{{ route('inbox.disposition', ['letterReceiver' => $letterReceiver->id]) }}" method="POST">
            @method('POST')
            @csrf
            <div class="container-fluid mt-5">
                <div class="row mb-5">
                    <div class="col-md-3">
                        <h3>Tingkat Kerahasiaan</h3>
                    </div>
                    <div class="col-md-9">
                        <div class="pt-3" style="display: flex;  justify-content: space-between;">
                            @foreach ($security as $security)
                                <div class="form-check">
                                    <input style="color: black; border: rgb(70, 70, 70) 1px solid" class="form-check-input"
                                        id="{{$security}}" type="radio" name="security_level" value="{{$security}}"
                                        @if($disposition) disabled @endif
                                        @if ($disposition && $disposition->security_level == $security) checked @endif required>
                                    <label style="color: black" class="form-check-label" for="{{$security}}">
                                        {{$security}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-3">
                        <label for="agenda" class="form-label">Nomor Agenda</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="agenda_number" class="form-control" id="agenda"
                            aria-describedby="emailHelp"
                            value=@if ($disposition) {{ $disposition->agenda_number }} disabled @endif required>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-3">
                        <label for="agenda" class="form-label">Tanggal Terima</label>
                    </div>
                    <div class="col-md-9">
                        <input type="date" name="receive_date" class="form-control" id="agenda"
                            aria-describedby="emailHelp"
                            value=@if ($disposition) {{ $disposition->receive_date }} disabled @endif required>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-3">
                        <label for="agenda" class="form-label">Tanggal Surat</label>
                    </div>
                    <div class="col-md-9">
                        <input type="date" name="purpose" class="form-control" id="agenda"
                            aria-describedby="emailHelp"
                            value=@if ($disposition) {{ $disposition->purpose }} disabled @endif required>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-3">
                        <label for="agenda" class="form-label">Asal Surat</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="from" class="form-control" id="agenda"
                            aria-describedby="emailHelp"
                            value=@if ($disposition) {{ $disposition->from }} disabled @endif required>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-3">
                        <label for="agenda" class="form-label">Hal</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="point" class="form-control" id="agenda"
                            aria-describedby="emailHelp"
                            value=@if ($disposition) {{ $disposition->point }} disabled @endif required>
                    </div>
                </div>
                <div class="row mb-5">
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
                <div class="row mb-5">
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
                <div class="row mb-5">
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
