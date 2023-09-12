@extends('layouts.app')

@section('content')
    <a href="{{ route('pdf.letter', ['letter' => $letter->id]) }}" target="_blank">Donwload</a>

    <div>Sent to</div>

    <div>Sent to</div>

    @foreach ($letter->letterReceivers as $receiver)
        <div>{{ $receiver->user->name }}</div>
        <div>
            <a href="{{ route('sent.receiver.show', [
                'id' => $letter->id,
                'receiver_id' => $receiver->id,
            ]) }}"
                class="btn btn-primary btn-sm">
                Detail
            </a>
        </div>
    @endforeach
@endsection
