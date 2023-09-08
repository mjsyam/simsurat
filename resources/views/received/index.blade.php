@extends('layouts.app')

@section('content')

<div>
    <h3 class="">Surat Belum Dibaca</h3><br>
    <div class="mb-4">
        <a href="{{route('sent.letter-create')}}" class="btn btn-success px-7">
            Add
        </a>
    </div>
    <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-4">
        <div class="table-responsive">
            <table class="table table-striped" id="sent_letter_table">
                <thead>
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th>#</th>
                        <th>Nomor Surat</th>
                        <th>Judul Surat</th>
                        <th>Kategori Surat</th>
                        <th>Tanggal dibuat</th>
                        <th>Status</th>
                        <th class="w-100px">#</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
