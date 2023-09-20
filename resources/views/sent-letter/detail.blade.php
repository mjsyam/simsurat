@extends('layouts.app')

@section('content')
    <a href="{{ asset("/storage/letter/$letter->file") }}" target="_blank">Donwload</a>

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
