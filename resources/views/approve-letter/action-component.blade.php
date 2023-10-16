<div class="btn-detail" id="btn-{{$letter->id}}+">
    <a href="{{asset("/storage/letter/$letter->file")}}" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
    <form action="{{route("approve.letter.approve", ["id" => $letter->id])}}">
        @csrf
        <button type="submit" class="dropdown-item py-2"><i class="fa-solid fa-check me-2"></i> Approve</button>
    </form>
</div>
