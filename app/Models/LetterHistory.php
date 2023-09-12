<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function letterReceiver() {
        return $this->belongsTo(LetterReceiver::class, "letter_receivers_id");
    }

    public function approver() {
        return $this->belongsTo(User::class, "approver_id");
    }
}
