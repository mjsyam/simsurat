@extends('layouts.app')

@section('content')
    <h4>{{ $receiver->letter->title }} <span class="badge"
            style="background-color: rgb(25, 149, 220)">{{ $receiver->letterStatus->status ?? '' }}</span>
        @if ($receiver->letterStatus->status != 'Menunggu Persetujuan')
            <span class="badge"
                style="background-color: @if($receiver->letterStatus->read == false) {{'rgb(246, 159, 72)'}} @else {{"rgb(34,139,34)"}} @endif">{{ $receiver->letterStatus->read == false ? 'Belum Dibaca' : 'Sudah Dibaca' }}</span>
        @endif
    </h4>
    <div class="d-flex justify-content-between">
        <div class="">
            <h6>{{ $receiver->letter->signed->name }} <span
                    style="color: gray">{{ '<' . $receiver->letter->signed->email . '>' }}</span></h6>
            <h6><span style="color: gray">Kepada {{ $receiver->user->name }}</span></h6>
        </div>
        <div class="text-right">
            <h6><span style="color: gray">{{Carbon\Carbon::parse($receiver->letter->date)->format('d M Y')}}</span></h6>
            <a href="{{ asset("/storage/letter/{$receiver->letter->file}") }}" class="btn btn-light-success btn-sm text-center">
                <i class="fa-solid fa-download ms-5 m-auto"></i> Download
            </a>
        </div>
    </div>

    <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
        <div class="table-responsive">
            <h4 class="c-grey-900 mB-20">Riwayat Penerima Surat</h4>
            <table class="table table-striped" id="sent_letter_table">
                <thead>
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th>#</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                    @foreach ($receiver->letterHistories as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $history->note }}</td>
                            <td>{{ $history->status }}</td>
                            <td>{{ $history->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
