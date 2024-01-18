<div class="btn-detail">
    <a href="/inbox/detail/{{$id}}" class="dropdown-item py-2">
        <i class="fa-solid fa-wrench me-3"></i> Aksi</a>
</div>
<div class="btn-detail">
    <a href="{{route("sent.receiver.show", ["id" => $id])}}" class="dropdown-item py-2">
        <i class="fa-solid fa-eye me-3"></i>
        Riwayat Status
    </a>
</div>
