<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-ellipsis-vertical"></i>
</button>
<ul class="dropdown-menu">
    <li>
        <a href="{{ route('admin.identifier.detail', ['identifier' => $identifier]) }}" class="dropdown-item py-2">
            <i class="fa-solid fa-id-badge me-3"></i>
            Detail
        </a>
        <a href="#delete_identifier_modal" class="dropdown-item py-2" data-bs-toggle="modal"
            onclick="onDeleteIdentifierModalOpen({
                id: {{ $identifier }},
            })">
            <i class="fa-solid fa-trash me-3"></i>
            Delete
        </a>
    </li>
</ul>
