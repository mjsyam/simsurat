<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function letterReceiver()
    {
        return $this->belongsTo(LetterReceiver::class);
    }

    public function approver()
    {
        return $this->belongsTo(UserRole::class);
    }
}
