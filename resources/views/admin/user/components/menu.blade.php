<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-ellipsis-vertical"></i>
</button>
<ul class="dropdown-menu">
    <li>
        <a href="{{route('admin.user.detail', ["id" => $userId])}}" class="dropdown-item py-2">
            <i class="fa-solid fa-id-badge me-3"></i>
            Profile
        </a>
        <a href="" class="dropdown-item py-2" data-bs-toggle="modal">
            <i class="fa-solid fa-pen  me-3"></i>
            Edit
        </a>
        <a href="" class="dropdown-item py-2" data-bs-toggle="modal">
            <i class="fa-solid fa-trash me-3"></i>
            Delete
        </a>
    </li>
</ul>
