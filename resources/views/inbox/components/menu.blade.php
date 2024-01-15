<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-ellipsis-vertical"></i>
</button>
<ul class="dropdown-menu">
    <li>
        <div class="btn-detail">
            <a href="/inbox/detail/{{$id}}" class="dropdown-item py-2">
              <i class="fa-solid fa-eye me-3"></i>Detail</a>
        </div>
    </li>
    <li>
        <div class="btn-detail" onclick="onDetailButtonClick({{ $letterId }})">
            <a href="#letter_detail" data-bs-toggle="modal" class="dropdown-item py-2">
                <i class="fa-solid fa-eye me-3"></i>
                Riwayat Status
            </a>
        </div>
    </li>
</ul>
