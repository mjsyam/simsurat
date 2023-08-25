@extends('layouts.app')

@section('content')

<button>Donwload</button>

<div>Sent to</div>

@foreach ($letter->letterReceivers as $receiver)

<div>{{$receiver->user->name}}</div>
<div>
    <a href="{{route('sent.receiver.show', [
            'id' => $letter->id,
            'receiver_id' =>$receiver->id
        ])}}" class="btn btn-primary btn-sm">
        Detail
    </a>
</div>
@endforeach

@endsection
