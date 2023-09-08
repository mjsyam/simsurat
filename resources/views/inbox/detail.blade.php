@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div style="background-color: #E6EEFA" class="mb-2 py-5 px-4">
        <h1>Tools</h1>
        <hr>
        <form action="{{ route('inbox.disposition', ['letterReceiver' => $letterReceiver]) }}" method="POST">
            @method('POST')
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <h5>Disposisi : </h5>
                </div>
                <div class="col-md-6">
                    <select class="dispositionSelect for" name="disposition_id" style="width: 100%">
                    </select>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-success btn-sm">Submit</button>
                </div>
            </div>
        </form>
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
                                <p class="fs-3 mb-0 font-weight-bold">LEMBAGA PENELITIAN DAN PENGABDIAN MASYARAKAT</p>
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

        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <div class="row mb-3">
                                    <div class="col-md-2">Nomor</div>
                                    <div class="col-md-5">: 192/153/12</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2">Hal</div>
                                    <div class="col-md-5">: 19</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">8 September 2023</div>
                    </div>
                    <div class="content">
                        <p>Yth. Archie Dylan Ramadhan</p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, nulla. Beatae quis commodi
                            autem ipsam repellat, ullam amet quia id minus sunt voluptate voluptatum. Voluptates modi
                            facilis tenetur ad cupiditate.
                        </p>
                    </div>
                    <div class="signature">
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <p>Ketua Senat</p>
                                <img src="{{ asset('images/ttd.png') }}" class="mt-4" style="max-height: 50px;">
                                <p>Prof. Archie Dylan S.Kom., M.Kom.</p>
                                <p>NIP. 14022</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var selectDisposition = document.querySelector(".dispositionSelect");

        const users = @json($users);
        // dummy
        // option.value = "1"; 
        // option.text = "YourOptionText"; 
        users.forEach(user => {
            if (user.id != {{Auth::user()->id}} && user.id != {{ $letter->user_id }}) {
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
