<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function letterCategory()
    {
        return $this->belongsTo(LetterCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signed()
    {
        return $this->belongsTo(User::class, "signed_id");
    }

    public function letterHistories()
    {
        return $this->hasMany(LetterHistory::class);
    }

    public function dispositions()
    {
        return $this->hasMany(Disposition::class);
    }

    public function letterReceivers()
    {
        return $this->hasMany(LetterReceiver::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
