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
    <div style="background-color: #E6EEFA" class="mb-2 py-5 px-4">
        <h1>Tools</h1>
        <hr>

        {{-- @if ($letterReceiver->disposition_id == null) --}}
            {{-- <form action="{{ route('inbox.disposition', ['letterReceiver' => $letterReceiver]) }}" method="POST">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <h5>Disposisi : </h5>
                    </div>
                    <div class="col-md-6">
                        @if ($letterReceiver->disposition_id == null)
                            <select class="dispositionSelect for" name="disposition_id" style="width: 100%">
                            </select>
                        @else
                            <div class="alert alert-success text-black" role="alert">
                                Surat telah di disposisikan kepada {{ $letterReceiver->user_disposition->name }}
                            </div>
                        @endif
                    </div>
                    @if ($letterReceiver->disposition_id == null)
                        <div class="col-md-2">
                            <button class="btn btn-success btn-md">Submit</button>
                        </div>
                    @endif
                </div>
            </form> --}}
        {{-- @endif --}}


        <a href="{{ asset("/storage/letter/$letter->file") }}" class="btn btn-success">Download Letters</a>
    </div>

    <div style="background: white">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-3 my-auto">
                            <img src="{{ asset('images/logo-itk.png') }}" class="h-[130px]">
                        </div>
                        <div class="col-md-9 text-center">
                            <div class="">
                                <p class="fs-3 mb-0">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</p>
                                <p class="fs-3 mb-0">RISET, DAN TEKNOLOGI</p>
                                <p class="fs-3 mb-0">INSTITUT TEKNOLOGI KALIMANTAN</p>
                                <p class="fs-3 mb-0 font-weight-bold">{{ $letter->title }}</p>
                            </div>
                            <div>
                                <p class="fs-6 mb-0">Kampus ITK Karang Joang, Balikpapan 76127</p>
                                <p class="fs-6 mb-0">Telepon (0542) 8530801 Faksimile (0542) 8530800</p>
                                <p class="fs-6 mb-0">Surat elektronik : lppm@itk.ac.id laman : www.itk.ac.id</p>
                            </div>
                        </div>
                        <hr style="border: 2px solid #000000;">
                    </div>
                </div>
            </div>
        </div>

        @if(!$letterReceiver->disposition)
        <form action="{{ route('inbox.disposition', ['letterReceiver' => $letterReceiver->id ]) }}" method="POST">
            @method('POST')
            @csrf
        @endif

            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="letter-content pt-3" style="display: flex;  justify-content: space-between;">
                            <div>
                                <input id="sangatRahasia" type="radio" name="security_level" value="Sangat Rahasia" @if($disposition && $disposition->security_level == "Sangat Rahasia") checked @endif> 
                                <label for="sangatRahasia">
                                    Sangat Rahasia
                                </label>
                            </div>
                            <div>
                                <input id="rahasia" type="radio" name="security_level" value="Rahasia" @if($disposition && $disposition->security_level == "Rahasia") checked @endif> 
                                <label for="rahasia">
                                    Rahasia
                                </label>
                            </div>
                            <div>
                                <input id="sangatSegera" type="radio" name="security_level" value="Sangat Segera" @if($disposition && $disposition->security_level == "Sangat Segera") checked @endif> 
                                <label for="sangatSegera">
                                    Sangat Segera
                                </label>
                            </div>
                            <div>
                                <input id="segera" type="radio" name="security_level" value="Segera" @if($disposition && $disposition->security_level == "Segera") checked @endif> 
                                <label for="segera">
                                    Segera
                                </label>
                            </div>
                            <div>
                                <input id="biasa" type="radio" name="security_level" value="Biasa" @if($disposition && $disposition->security_level == "Biasa") checked @endif> 
                                <label for="biasa">
                                    Biasa
                                </label>
                            </div>
                        </div>
                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Nomor Agenda</td>
                                    <td style="width: 2%">:</td>
                                    <td>
                                        <input type="number" name="agenda_number" class="w-100 d-inline" style="border: none; border-bottom: 1px solid #000;" value=@if($disposition) {{$disposition->agenda_number}} @endif>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Terima</td>
                                    <td>:</td>
                                    <td>
                                        <input type="date" name="receive_date" class="w-100 d-inline" style="border: none; border-bottom: 1px solid #000;" value=@if($disposition) {{$disposition->receive_date}} @endif>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>:</td>
                                    <td>
                                        <input type="date" name="purpose" class="w-100 d-inline" style="border: none; border-bottom: 1px solid #000;" value=@if($disposition) {{$disposition->purpose}} @endif>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Asal Surat</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="from" class="w-100 d-inline" style="border: none; border-bottom: 1px solid #000;" value=@if($disposition) {{$disposition->from}} @endif>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hal</td>
                                    <td>:</td>
                                    <td>                                                
                                        <input type="number" name="point" class="w-100 d-inline" style="border: none; border-bottom: 1px solid #000;" value=@if($disposition) {{$disposition->point}} @endif>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- disposisiton section --}}
                        <div class="letter-content" style="margin: 0; padding: 0">
                            <h5>Diteruskan Kepada :</h5>
                            <div class="row">
                                <div class="col-md-6" style="margin-right: 0; padding-right: 0">
                                    @if($role1)
                                        @foreach ($role1 as $role)
                                            <div class="letter-content">
                                                <input id="role2-{{ $role->id }}" type="checkbox" name="disposition_to[]" value="{{ $role->id }}" @if( $dispositionTos && in_array($role->id, $dispositionTos->toArray())) checked @endif>
                                                <label for="role2-{{ $role->id }}">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-6" style="margin-left: 0; padding-left: 0">
                                    @if($role2)
                                        @foreach ($role2 as $role)
                                            <div class="letter-content">
                                                <input id="role2-{{ $role->id }}" type="checkbox" name="disposition_to[]" value="{{ $role->id }}" @if( $dispositionTos && in_array($role->id, $dispositionTos->toArray())) checked @endif>
                                                <label for="role2-{{ $role->id }}">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- information section --}}
                        <div class="letter-content" style="margin: 0; padding: 0">
                            <h5>Untuk :</h5>
                            <div class="row">
                                <div class="col-md-6" style="margin-right: 0; padding-right: 0">
                                    @foreach ($information1 as $information)
                                        <div class="letter-content">
                                            <input id="information1-{{ $information }}" type="checkbox" name="information[]" value="{{ $information }}" @if($informations && in_array($information, $informations->toArray())) checked @endif>
                                            <label for="information1-{{ $information }}">
                                                {{ $information }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6" style="margin-left: 0; padding-left: 0">
                                    @foreach ($information2 as $information)
                                        <div class="letter-content">
                                            <input id="information2-{{ $information }}" type="checkbox" name="information[]" value="{{ $information }}" @if($informations && in_array($information, $informations->toArray())) checked @endif>
                                            <label for="information2-{{ $information }}">
                                                {{ $information }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- description --}}
                        <div class="letter-content">
                            <h5>Keterangan : </h5>
                            <textarea class="form-control" rows="4" name="description">@if($disposition){{$disposition->information}} @endif</textarea>
                        </div>
                        @if(!$disposition)
                            <div class="text-right my-5">
                                <button class="btn btn-success btn-md">Disposisi</button>
                            </div>
                        @endif
                    </div>
                </div>
               
            </div>
            
        </form>

    </div>
@endsection

@section('script')
    <script>
        var selectDisposition = document.querySelector(".dispositionSelect");

        const users = @json($users);
        users.forEach(user => {
            if (user.id != {{ Auth::user()->id }} && user.id != {{ $letter->user_id }}) {
                var option = document.createElement("option");
                option.value = user.id;
                option.text = user.name;
                selectDisposition.appendChild(option);
            }
        });

        var data = [];

        var placeholder = "select";
        $(".dispositionSelect").select2(selectDisposition, {
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
