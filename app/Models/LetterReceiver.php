<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterReceiver extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function letterStatuses()
    {
        return $this->hasMany(LetterStatus::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
