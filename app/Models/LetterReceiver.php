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

    public function user_disposition()
    {
        return $this->belongsTo(User::class, 'disposition_id', 'id');
    }

    public function letterStatus()
    {
        return $this->hasOne(LetterStatus::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function letterHistories()
    {
        return $this->hasMany(LetterHistory::class)->orderBy("created_at", "desc");
    }

    public function disposition()
    {
        return $this->hasOne(User::class, 'id', 'disposition_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
