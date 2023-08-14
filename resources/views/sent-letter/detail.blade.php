@extends('layouts.app')

@section('content')

<button>Donwload</button>

<div>Sent to</div>

@foreach ($letter->letterReceivers as $receiver)
    <div>{{$receiver->user->name}}</div>
@endforeach

@endsection
