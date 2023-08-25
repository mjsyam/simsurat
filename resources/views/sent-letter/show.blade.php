@extends('layouts.app')

@section('content')
<div class="d-flex flex-column ">
    <div class="card mb-3">
        <div class="bgc-white mt-4 p-10">
            <div class="card-header">
                <h3>Detail Surat</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="">
                        <tr>
                            <th scope="col text-center">
                                <h5><strong>Properti<strong></h5>
                            </th>
                            <th scope="col text-center">
                                <h5><strong>Data Surat<strong></h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Kategori Surat</strong>
                            </td>
                            <td>
                                {{ $letter->letterCategory->category }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Judul Surat</strong>
                            </td>
                            <td>
                                {{ $letter->title }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Nomor Surat</strong>
                            </td>
                            <td>
                                {{ $letter->refrences_number }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Tujuan Surat</strong>
                            </td>
                            <td>
                                {{ $letter->letter_destination }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Isi Surat</strong>
                            </td>
                            <td>
                                {{ $letter->body }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Tanggal Surat</strong>
                            </td>
                            <td>
                                {{ $letter->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="bgc-white mt-4 p-10">
            <div class="card-header">
                <h3>Riwayat Status Surat</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="">
                        <tr>
                            <th scope="col text-center">
                                <h5><strong>Waktu<strong></h5>
                            </th>
                            <th>
                                <h5><strong>Catatan<strong></h5>
                            </th>
                            <th scope="col text-center">
                                <h5><strong>Approver<strong></h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($letter->letterHistories as $letterHistory)
                        <tr>
                            <td>
                                {{ $letterHistory->created_at->format('d M Y') }}
                            </td>
                            <td>
                                {{ $letterHistory->note }}
                            </td>
                            <td>
                                {{ $letterHistory->approver ? $letterHistory->approver->name : 'Belum Diizinkan' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
