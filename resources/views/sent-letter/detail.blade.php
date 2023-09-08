@extends('layouts.app')

@section('content')
    <a href="{{ route('sent.letter-exports', ["id" => $letter->id])}}" target="_blank">Donwload</a>

    <div>Sent to</div>

    @foreach ($letter->letterReceivers as $receiver)
        <div>{{ $receiver->user->name }}</div>
    @endforeach

@endsection
