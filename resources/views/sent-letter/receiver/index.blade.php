@extends('layouts.app')

@section('content')

<div>Sent to</div>

<div>{{$receiver->user->name}}</div>
<div class="d-flex flex-row">
    <label class="mr-3">
        Judul Surat :
    </label>
    <div>
        {{$receiver->letter->title}}
    </div>
</div>
<div class="d-flex flex-row">
    <label class="mr-3">
        Status Surat :
    </label>
    <div>
        {{$receiver->letterStatus->status ?? ""}}
    </div>
</div>
<div class="d-flex flex-row">
    <label class="mr-3">
        Surat Dibaca :
    </label>
    <div>
        {{$receiver->letterStatus->read ?? false ? 'Sudah' : 'Belum'}}
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
                    <td>{{$loop->iteration}}</td>
                    <td>{{$history->note}}</td>
                    <td>{{$history->status}}</td>
                    <td>{{$history->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
