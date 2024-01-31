<div class="btn-detail" id="btn-{{$letter->id}}+">
    <a href="{{asset("/storage/letter/$letter->file")}}" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
    @if ($letter->letterReceivers->first()->letterHistories->first()->status == "Menunggu Persetujuan")
        <form action="{{route("approve.letter.approve", ["id" => $letter->id])}}" method="post">
            @csrf
            <button type="submit" name="action" value="approved" class="dropdown-item py-2"><i class="fa-solid fa-check me-2"></i> Approve</button>
            <button type="submit" name="action" value="rejected" class="dropdown-item py-2"><i class="fa-solid fa-x me-2"></i> Reject</button>
        </form>
    @endif
</div>
