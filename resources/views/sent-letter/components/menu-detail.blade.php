<a href="{{ route('sent.receiver.show', [
    'id' => $letter->letter_id,
    'receiver_id' => $letter->user_id,
]) }}" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center">
    <i class="fas fa-eye mr-1"></i>
    View
</a>
